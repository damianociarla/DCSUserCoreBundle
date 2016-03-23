<?php

namespace DCS\User\CoreBundle;

class DCSUserCoreEvents
{
    const USER_CREATED      = 'dcs_user.core.event.user_created';
    
    const BEFORE_SAVE_USER  = 'dcs_user.core.event.before_save_user';
    const SAVE_USER         = 'dcs_user.core.event.save_user';
    const AFTER_SAVE_USER   = 'dcs_user.core.event.after_save_user';

    const BEFORE_DELETE_USER  = 'dcs_user.core.event.before_delete_user';
    const DELETE_USER         = 'dcs_user.core.event.delete_user';
    const AFTER_DELETE_USER   = 'dcs_user.core.event.after_delete_user';
}