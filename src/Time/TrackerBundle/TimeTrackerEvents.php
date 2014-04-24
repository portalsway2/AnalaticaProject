<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Time\TrackerBundle;

/**
 * Contains all events thrown in the FOSUserBundle
 */
final class TimeTrackerEvents
{
    /**
     * The CHANGE_PASSWORD_INITIALIZE event occurs when the change password process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
     */
    const CHANGE_PASSWORD_INITIALIZE = 'time_tracker.change_password.edit.initialize';

    /**
     * The CHANGE_PASSWORD_SUCCESS event occurs when the change password form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     * The event listener method receives a FOS\UserBundle\Event\FormEvent instance.
     */
    const CHANGE_PASSWORD_SUCCESS = 'time_tracker.change_password.edit.success';

    /**
     * The CHANGE_PASSWORD_COMPLETED event occurs after saving the user in the change password process.
     *
     * This event allows you to access the response which will be sent.
     * The event listener method receives a FOS\UserBundle\Event\FilterUserResponseEvent instance.
     */
    const CHANGE_PASSWORD_COMPLETED = 'time_tracker.change_password.edit.completed';


    /**
     * The PROFILE_EDIT_INITIALIZE event occurs when the profile editing process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
     */
    const PROFILE_EDIT_INITIALIZE = 'time_tracker.profile.edit.initialize';

    /**
     * The PROFILE_EDIT_SUCCESS event occurs when the profile edit form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     * The event listener method receives a FOS\UserBundle\Event\FormEvent instance.
     */
    const PROFILE_EDIT_SUCCESS = 'time_tracker.profile.edit.success';

    /**
     * The PROFILE_EDIT_COMPLETED event occurs after saving the user in the profile edit process.
     *
     * This event allows you to access the response which will be sent.
     * The event listener method receives a FOS\UserBundle\Event\FilterUserResponseEvent instance.
     */
    const PROFILE_EDIT_COMPLETED = 'time_tracker.profile.edit.completed';
}