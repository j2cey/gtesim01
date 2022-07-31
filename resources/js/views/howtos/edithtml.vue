<template>
    <div>
        <label for="rich-text" class="form-label">{{ howto.title }}</label>
        <quill-editor v-model="form.body"
                      class="mb-3"
                      id="rich-text"
                      rows="20"
                      :options="editorOption"
                      ref="myQuillEditor"
                      @blur="onEditorBlur($event)"
                      @focus="onEditorFocus($event)"
                      @ready="onEditorReady($event)">
        </quill-editor>
        <div class="custom-file d-none">
            <input ref="image" @change="imageUpload($event)" type="file" class="custom-file-input" id="imageUpload" aria-describedby="imageUploadAddon">
            <label class="custom-file-label" for="imageUpload">Choose file</label>
        </div>
        <button @click="submitForm" class="btn btn-sm btn-success">Save</button>
    </div>
</template>

<script>
    // Import Quill required dependencies
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    import { quillEditor, Quill } from 'vue-quill-editor'
    import ImageResize from 'quill-image-resize';

    // Register ImageResize module
    Quill.register('modules/imageResize', ImageResize);

    // Set toolbar options
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],

        [{'header': 1}, {'header': 2}],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}],
        [{'indent': '-1'}, {'indent': '+1'}],
        [{'direction': 'rtl'}],

        [{'size': ['small', false, 'large', 'huge']}],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],

        [{'color': []}, {'background': []}],
        [{'font': []}],
        [{'align': []}],
        ['link', 'image', 'video'],
        ['clean'],
    ];

    export default {
        name: "howto-edithtml",
        props: {
            howto_prop: {}
        },
        components: {
            quillEditor
        },
        data() {
            return {
                howto: this.howto_prop,
                form: {
                    body: this.howto_prop.htmlbody,
                    howto: this.howto_prop.id,
                    images: []
                },
                editorOption: {
                    modules: {
                        toolbar: {
                            container: toolbarOptions,
                            handlers: {
                                'image': function (value) {
                                    if (value) {
                                        document.querySelector('#imageUpload').click();
                                    } else {
                                        this.quill.format('image', false);
                                    }
                                }
                            },
                        },
                        history: {
                            delay: 1000,
                            maxStack: 50,
                            userOnly: false
                        },
                        imageResize: {
                            displayStyles: {
                                backgroundColor: 'black',
                                border: 'none',
                                color: 'white'
                            },
                            modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                        }
                    }
                },
            }
        },
        methods: {
            onEditorBlur(editor) {
                // console.log('editor blur!', editor)
            },
            onEditorFocus(editor) {
                // console.log('editor focus!', editor)
            },
            onEditorReady(editor) {
                // console.log('editor ready!', editor)
            },
            submitForm(){
                axios.post('/howtos.storehtml',
                    { body: this.form.body, images: this.form.images, howto: this.howto.id })
                    .then(response => {

                        this.$swal({
                            html: '<small>HTML Rubrique modifié avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            window.location = '/howtos.readhtml/' + this.howto.id
                        })

                    })
                    .catch(error => {
                        console.log("Error", error)
                    })
            },
            imageUpload(e) {
                if (e.target.files.length !== 0) {

                    let quill = this.editor;
                    let reader = new FileReader();
                    reader.readAsDataURL(e.target.files[0]);
                    let self = this;
                    reader.onloadend = function() {
                        let base64data = reader.result;
                        self.form.images.push(base64data);

                        // Get cursor location
                        let length = quill.getSelection().index;

                        // Insert image at cursor location
                        quill.insertEmbed(length, 'image', base64data);

                        // Set cursor to the end
                        quill.setSelection(length + 1);
                    }
                }
            },
        },
        computed: {
            editor(){
                return this.$refs.myQuillEditor.quill
            }
        },
    }
</script>

<style scoped>

</style>
