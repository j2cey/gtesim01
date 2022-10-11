import Vue from 'vue'
import ClientEsimBus from "./clientesimBus";

class PhoneNum {
    constructor(phonenum) {
        this.numero = phonenum.numero || ''
        this.client_esim = phonenum.client_esim || ''
    }
}

export default {
    showPreviewPDF(phonenum) {
        window.location = '/clientesims.previewpdf/' + phonenum.id
    },
    showClientEsim(clientesim) {
        window.location = '/clientesims/' + clientesim.uuid
    },
    changePhoneNumEsim(phonenum, clientesim) {

        let phonenumForm = new Form(
            new PhoneNum({
                'numero': phonenum.numero,
                'client_esim': clientesim
            })
        )

        Swal.fire({
            html: '<small>Affecter une nouvelle eSIM au <b>' + phonenum.numero + '</b></small>',
            icon: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Valider',
            cancelButtonText: 'Annuler',
            preConfirm: () => {
                return fetch(`/phonenums.getchangeesim/${phonenum.id}`)
                    .then(response => {
                        /*
                        if (!response.ok) {
                        throw new Error(response.statusText)
                        }*/
                        return response.json()
                    })
                    .catch(error => {
                        console.log("request failed: ", error)
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            }, allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                ClientEsimBus.$emit('phonenum_esim_changed', {'phonenum': result.value.phonenum, 'clientesim': clientesim})
                Swal.fire({
                    html: '<small>Nouvelle eSIM affectée avec Succes !</small>',
                    icon: 'success',
                    timer: 3000
                }).then(() => {
                    this.showPreviewPDF(result.value.phonenum)
                })
            }
        })
    },
    deletePhoneNum(phonenum, clientesim) {
        let phonenumForm = new Form(
            new PhoneNum({
                'numero': phonenum.numero,
                'client_esim': clientesim
            })
        )
        Swal.fire({
            html: '<small>Voulez-vous vraiment supprimer ce Numéro ?</small>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui',
            cancelButtonText: 'Non'
        }).then((result) => {
            if(result.value) {
                phonenumForm.put(`/clientesims.deletephone/${clientesim.uuid}`)
                    .then(resp => {

                        console.log('phonenum delete resp: ', resp)

                        Swal.fire({
                            html: '<small>Numéro supprimé avec succès !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            ClientEsimBus.$emit('phonenum_deleted', {'phonenum': phonenum, 'clientesim': clientesim})
                        })
                    }).catch(error => {
                    window.handleErrors(error)
                })

            } else {
                // stay here
            }
        })
    },
}
