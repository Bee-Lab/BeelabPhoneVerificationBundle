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

Create a ``Phone`` entity that exteands ``Beelab\PhoneVerificationBundle\Entity`` and put in your main configuration:

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

See ``https://bitbucket.org/vittorezen/skebby-bundle`` for more informations on how install and setup that bundle.
