'use strict';
import { showConfirmation } from './common-function';
import axios from 'axios';
import '@popperjs/core';
import '@form-validation/plugin-bootstrap';

document.addEventListener('DOMContentLoaded', function () {
  var forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      },
      false
    );
  });
});

function clock() {
  var dateElement = document.getElementById('current-date');
  var timeElement = document.getElementById('current-time');
  const now = new Date();
  timeElement.textContent = now.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit' });
  dateElement.textContent = now.toISOString().split('T')[0];
}

setInterval(clock, 1000);

$('#clockInCanvasBtn').on('click', function () {
  axios.get(`/clock-in`).then(res => {
    let { hasHistory } = res.data;
    if (hasHistory) {
      alert('You already have an active work in progress.');
    } else {
      $('#clockInCanvas').offcanvas('show');
    }
  });
});

$('#clockOutCanvasBtn').on('click', function () {
  axios.get(`/clock-out`).then(res => {
    let { clockHistory } = res.data;
    if (clockHistory !== null) {
      if (clockHistory.in_pause) {
        alert("You are currently on pause and can't clock-out at the moment.");
      } else {
        let form = $('#clock-out-edit-form');
        form.attr('action', form.attr('action') + '/' + clockHistory.id);
        $('#id').val(clockHistory.id);
        $('#clockOutCanvas').offcanvas('show');
      }
    } else {
      alert('There are no ongoing tasks to clock-out at the moment.');
    }
  });
});

$('#pauseWorkCanvasBtn').on('click', function () {
  axios.get(`/pause-work`).then(res => {
    let { clockHistory, clockPauseHistory } = res.data;
    console.log(clockHistory);
    console.log(clockPauseHistory);
    if (clockHistory !== null) {
      if (clockHistory.in_pause && clockPauseHistory != null) {
        $('#end_clock_history_id').val(clockHistory.id);
        $('#clock_pause_history_id').val(clockPauseHistory.id);
        $('#pauseWorkEndCanvas').offcanvas('show');
      } else {
        $('#start_clock_history_id').val(clockHistory.id);
        $('#pauseWorkStartCanvas').offcanvas('show');
      }
    } else {
      alert('There are no ongoing tasks to pause at the moment.');
    }
  });
});

$('input[name="reason_option"]').on('change', function () {
  var selectedReason = $('input[name="reason_option"]:checked').val();
  $('#reason').val(selectedReason);
});
