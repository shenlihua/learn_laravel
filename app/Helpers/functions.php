<?php
//用户登录密码
function encrypted_password($value) {
    return md5($value.md5($value.'md5').'md5');
}