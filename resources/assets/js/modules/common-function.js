'use strict';

export function showConfirmation(message, successBtn, cancelBtn) {
    return new Promise((resolve, reject) => {
        $('#confirm-msg').text(message);
        $('#confirm-success').text(successBtn);
        $('#confirm-cancel').text(cancelBtn);
        $('#confirmation-modal').modal('show');
  
        $('#confirm-success').one('click', function () {
            $('#confirmation-modal').modal('hide');
            resolve(true);
        });
  
        $('#confirm-cancel').one('click', function () {
            $('#confirmation-modal').modal('hide');
            resolve(false);
        });
    });
  }