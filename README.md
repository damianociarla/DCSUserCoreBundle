# DCSUserCoreBundle

The **DCSUserCoreBundle** is the main part of a set of libraries that help you in the most common 
tasks for managing users.

It provides the abstraction of operations such as saving, deleting and searching for a single user. 
As? Through specific events.

**Note:** This bundle does *not* provide the final implementation of the operations but you must add and configure libraries (or create your own) to ensure the execution of commands

## Introduction

This bundle offers a number of services which in itself do not develop the entire operating logic, but they need of external services to work.

The list of exposed services is as follows:

* `dcs_user.manager.save`
* `dcs_user.manager.delete`
* `dcs_user.factory`
* `dcs_user.repository`

### The services

##### a) The managers

The `dcs_user.manager.save` and `dcs_user.manager.delete` services do not perform the save or cancellation but emit a series of the events that can be used to perform the real action.

##### b) The factory

The `dcs_user.factory` has the task of creating a new user instance

##### c) The repository

The `dcs_user.repository` is only an interface that exposes methods for the user's search. It must be implemented as a service and added in the bundle configuration

### The events

Listeners hooked to events emitted by the various services will always receive an instance of `DCS\User\CoreBundle\Event\UserEvent`.

The complete list of events is within the class `DCS\User\CoreBundle\DCSUserCoreEvents`.

## The DCS bundles

Several bundles have been developed that help you perform common tasks for user management:

##### Persistence

[https://github.com/damianociarla/DCSUserPersistenceORMBundle](https://github.com/damianociarla/DCSUserPersistenceORMBundle) 

*This bundle provides you the implementation of the persistence on database using Doctrine ORM. **Requirerment:** DCSUserCoreBundle*

##### Role management

[https://github.com/damianociarla/DCSRoleCoreBundle](https://github.com/damianociarla/DCSRoleCoreBundle) 

*This bundle provides the basic services for the role management. **Requirerment:** DCSUserCoreBundle*

[https://github.com/damianociarla/DCSRoleProviderORMBundle](https://github.com/damianociarla/DCSRoleProviderORMBundle) 

*This bundle provides you with the management of user roles using Doctrine ORM. **Requirerment:** DCSRoleCoreBundle*

[https://github.com/damianociarla/DCSRoleProviderArrayBundle](https://github.com/damianociarla/DCSRoleProviderArrayBundle) 

*This bundle provides you with the management of roles having the configuration as an array. **Requirerment:** DCSRoleCoreBundle*

##### Security

[https://github.com/damianociarla/DCSSecurityCoreBundle](https://github.com/damianociarla/DCSSecurityCoreBundle) 

*This bundle provides the basic services for the management of security. **Requirerment:** DCSUserCoreBundle*

[https://github.com/damianociarla/DCSSecurityAuthFormBundle](https://github.com/damianociarla/DCSSecurityAuthFormBundle) 

*This bundle provides an authentication system using the login form. **Requirerment:** DCSSecurityCoreBundle*

##### Password reset management

[https://github.com/damianociarla/DCSPasswordResetCoreBundle](https://github.com/damianociarla/DCSPasswordResetCoreBundle) 

*This bundle provides the logic to perform a complete flow of password change request. **Requirerment:** DCSUserCoreBundle, DCSSecurityCoreBundle*

[https://github.com/damianociarla/DCSPasswordResetPersistenceORMBundle](https://github.com/damianociarla/DCSPasswordResetPersistenceORMBundle) 

*This bundle provides the implementation of the persistence on database using Doctrine ORM of all password requests. **Requirerment:** DCSPasswordResetCoreBundle*

[https://github.com/damianociarla/DCSPasswordResetExplainViewBundle](https://github.com/damianociarla/DCSPasswordResetExplainViewBundle) 

*This bundle provides the visual display of password recovery services through view and form. **Requirerment:** DCSPasswordResetCoreBundle*

## Prerequisites

This version of the bundle requires Symfony 2.8+.

## Installation

### Require the bundle

Run the following command:

	$ composer require dcs/user-core-bundle "~1.0@dev"

Composer will install the bundle to your project's `vendor/dcs/user-core-bundle` directory.

### Enable the bundle

Enable the bundle in the kernel:

	<?php
	// app/AppKernel.php

	public function registerBundles()
	{
		$bundles = array(
			// ...
			new DCS\User\CoreBundle\DCSUserCoreBundle(),
			// ...
		);
	}

### Create your User class

Until now he has never talked about **persistence**. This because? Why DCSUserCoreBundle not know the logic of how they will be implemented the Save and Delete methods. It is allowed total freedom of implementation.

### Configure

Now that you have properly enabled this bundle, the next step is to configure it to work with the specific needs of your application.

Add the following configuration to your `config.yml`.

	dcs_user_core:
        model_class: Your\User\Class
        repository_service: your_repository_service

# Reporting an issue or a feature request

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/damianociarla/DCSUserCoreBundle/issues).