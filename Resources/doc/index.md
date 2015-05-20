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

Adapters
--------

Currently, the only supported adapter is Skebby.

See [Skebby bundle](https://bitbucket.org/vittorezen/skebby-bundle) for more informations on how install and setup that bundle.

Events
------

Currently, there is one event dispatched: ``beelab_phone_verification.phone_creation``. This event receives a
``PhoneEvent`` event, and you can listen to it to manipulate the ``Phone`` object just after its creation (and before
flushing).

For example, suppose you want to relate ``Phone`` with your ``User`` entity. You can add a ``$user`` property in your
``Phone`` entity, then listen to `beelab_phone_verification.phone_creation`` and set ``$user`` to current user.