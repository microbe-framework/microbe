/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.2
 *    Module: microbe.js
 *     Class:
 *     About: Minimal JavaScript file for sample application
 *     Begin: 2017/05/01
 *   Current: 2019/03/26
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license 
 *    Source: https://github.com/microbe-framework/microbe/
 ******************************************************************************/

/******************************************************************************
 *            This file is part of the Microbe PHP Framework.                 *
 *                                                                            *
 *         Copyright (c) 2017-2019 Microbe PHP Framework author               *
 *                  <microbe-framework@protonmail.com>                        *
 *                                                                            *
 *            For the full copyright and license information,                 *
 *                     please view the LICENSE file                           *
 *              that was distributed with this source code.                   *
 ******************************************************************************/

// Framework use special 'actionForm' for POST actions submit
// actionForm has 4 required modified fields: action, id, param1, param2
// and 1 required unmodified field: controller
// [?] action -> message, msg, cmd, command

const ACTION_FORM_ID = 'actionForm';

function go(url) {
  location.href=url;
}

function getById(form, id) {
  return form.elements.namedItem(id);
}

function getValueById(form, id) {
  return form.elements.namedItem(id).value;
}

function setValueById(form, id, value) {
  form.elements.namedItem(id).value = value;
}

function postAction(action, id, param1, param2) {
  var form = document.getElementById(ACTION_FORM_ID);
  setValueById(form, 'action', action ? action : null);
  setValueById(form, 'id',         id ? id     : null);
  setValueById(form, 'param1', param1 ? param1 : null);
  setValueById(form, 'param2', param2 ? param2 : null);
  form.submit();
}

function postActionEx(prompt, action, id, param1, param2) {
  if (confirm(prompt)) {
    postAction(action, id, param1, param2);
  }
}
