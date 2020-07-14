$(function() {

    // mettons notre formulaire dans une variable.
    var form = $('#formulairedecontact');
    
    // mettons notre div destiné au messags d'erreur dans une variable egalement.
    var formMessages = $('#msgErreur');
    
    // Configurons un écouteur d'événements pour notre formulaire de contact.
    $(form).submit(function(e) {
    // Empêchons le navigateur de soumettre le formulaire.
    e.preventDefault();
    
    // Sérialisons les données du formulaire.
    var formData = $(form).serialize();
    
    // Soumettez le formulaire avec AJAX.
    $.ajax({
    type: 'POST',
    url: $(form).attr('action'),
    data: formData
    })
    .done(function(response) {
    // Assurons-nous que la div formMessages a la classe 'success' en cas de succes.
    $(formMessages).removeClass('error');
    $(formMessages).addClass('success');
    
    // Définissons le texte du message.
    $(formMessages).text(response);
    
    // Effaçons le formulaire.
    $('#nom').val('');
    $('#email').val('');
    $('#subject').val('');
    $('#contenuMsg').val('');
    })
    .fail(function(data) {
    // Assurons-nous que la div formMessages a la classe «error» en cas d'erreur.
    $(formMessages).removeClass('success');
    $(formMessages).addClass('error');
    
    // Définissons le texte du message.
    if (data.responseText !== '') {
    $(formMessages).text(data.responseText);
    } else {
    $(formMessages).text('Oups! Une erreur s\'est produite et votre message n\'a pas pu être envoyé.');
    }
    });
    
    });
    
    });