==============
Button spinner
==============

Le FrontBundle intègre les `Spinners Bootstrap 5 <https://getbootstrap.com/docs/5.2/components/spinners>`_ pour faciliter leur ajout sur les boutons de validation.

**Par exemple :**

.. figure:: ../images/spinner/button.png
    :alt: Boutton sans spinner

Le bundle ajoute un spinner au bouton de validation du formulaire ci-dessus.

.. figure:: ../images/spinner/button-spinner.png
    :alt: Boutton avec un spinner

Ajouter un spinner
==================

Vous devez ajouter la classe ``btn-spin`` à vos ``button`` pour que le FrontBundle puisse ajouter automatiquement un spinner au boutton lors du clique.

Ajout manuel
------------

Pour ajouter manuellement un spinner sur n'importe quel élément, il faut utiliser la méthode ``FrontBundle.spinner.add(element)``

Par exemple :

.. code-block:: javascript

    FrontBundle.spinner.add(document.querySelector('#assure_save'));

Supprimer un spinner
====================

La suppression du spinner n'est pas nécessaire sur un formulaire Symfony car la page est rechargée pour afficher les éventuelles erreurs.

En revanche si vous envoyez votre formulaire en Ajax, vous devrez le supprimer manuellement avec la méthode ``FrontBundle.spinner.remove(element)``

Par exemple :

.. code-block:: javascript

    FrontBundle.spinner.remove(document.querySelector('#assure_save'));
