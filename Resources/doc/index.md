BeelabPhoneVerificationBundle
=============================

Installation
------------

```bash
composer require "beelab/phone-verification-bundle"
```

Setup
-----

Add ``new Beelab\PhoneVerificationBundle\BeelabPhoneVerificationBundle()`` in your ``AppKernel.php``.

Create a ``Phone`` entity that extends ``Beelab\PhoneVerificationBundle\Entity`` and put in your main configuration:

```yaml
# /app/config/config.yml
beelab_phone_verification:
    adapter:     skebby
    phone_class: AppBundle\Entity\Phone
    layout:      layout.html.twig
```

You can optionally specify the format of phone number, as a regular expression. The default expression is
``/^[0-9]{6,17}$/``, that allows for any number long between 6 and 17.
In the following example, only numbers starting with 393 (Italian mobile numbers) are allowed.

```yaml
# /app/config/config.yml
beelab_phone_verification:
    phone_number_regex: "^393[0-9]{8,9}$"
```

Adapters
--------

Currently, the only supported adapter is Skebby.

See [Skebby bundle](https://bitbucket.org/vittorezen/skebby-bundle) for more informations on how install and setup that bundle.

Events
------

#### Phone creation

The event ``beelab_phone_verification.phone_creation`` receives a ``PhoneEvent`` event, and you can listen to it
to manipulate the ``Phone`` object just after its creation (and before flushing).

For example, suppose you want to relate ``Phone`` with your ``User`` entity. You can add a ``$user`` property in your
``Phone`` entity, then listen to `beelab_phone_verification.phone_creation`` and set ``$user`` to current user.

#### SMS error

The event ``beelab_phone_verification.sms_error`` receives a ``SMSEvent`` event, and you can listen to it
to do some actions when SMS sending fails. The relevant exception is attached to this event.

For example, you could listen to ``beelab_phone_verification.sms_error`` to send an email each time that an SMS is not
sent (maybe it could be caused by zero credit remaining in your SMS service).
