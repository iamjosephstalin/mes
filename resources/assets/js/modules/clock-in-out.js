'use strict';
import { showConfirmation } from './common-function';
import axios from 'axios';
import '@popperjs/core';
import '@form-validation/plugin-bootstrap';

document.addEventListener('DOMContentLoaded', function () {});

function clock() {
  var dateElement = document.getElementById('current-date');
  var timeElement = document.getElementById('current-time');
  const now = new Date();
  timeElement.textContent = now.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit' });
  dateElement.textContent = now.toISOString().split('T')[0];
}

setInterval(clock, 1000);
