=========
Inputmask
=========

*FrontBundle* met à votre disposition la librairie `Inputmask <https://github.com/RobinHerbots/Inputmask>`_.

Cette librairie permet d'associer des masques de saisie aux champs de formulaire.

Les masques guident l'utilisateur en appliquant un formatage visuel et en contraignant la saisie.
Pour en savoir plus sur l'utilisation de cette librairie, consultez sa `documentation <https://github.com/RobinHerbots/Inputmask>`_.

Exemple de masque
-----------------

.. figure:: ../images/inputmask.png
    :alt: Inputmask

Utilisation
-----------

Plusieurs méthodes sont disponibles :

- En utilisant directement la classe ``Inputmask``.
- Au travers de la méthode *jQuery* ``.inputmask()``.
- L'attribut *HTML* ``data-inputmask``.
- L'élément *HTML* ``<input-mask></ input-mask>``.

Elle sont décrites dans la `documentation <https://github.com/RobinHerbots/Inputmask>`_.

.. note::
    L'utilisation de l'attribut ``data-inputmask`` est activée par *FrontBundle*. Vous pouvez directement utiliser cet attribut.
    Vous n'avez rien à faire côté *Javascript*.

.. code-block:: html

    <input name="ss" data-inputmask="'mask': '9 99 99 9(a|A|9) 999 999 99'" />

.. note::
    L'utilisation de l'attribut ``data-inputmask`` étant activée, vous pouvez piloter *InputMask* directement depuis les
    ``FormType`` *Symfony*.

.. code-block:: php

    $form->add('email', TextType::class, [
        'attr' => [
            'data-inputmask' => "'alias': 'email'",
        ]
    ]);
