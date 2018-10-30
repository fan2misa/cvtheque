{% use 'flash.html.twig' %}

<div class="container">

    {{ block('flash') }}
    {{ form_errors(form) }}

    <h1>{{ cv.user.fullName }}</h1>
    <h2>{{ form_row(form.nom) }}</h2>

    <h3>Informations générales</h3>

    <div class="media">
        <img class="mx-auto d-block img-fluid" src="{{ cv_avatar(cv) }}" alt="Generic placeholder image"/>
        <div class="media-body">
            <div class="container-fluid">
                <div class="form-group">
                    {{ form_row(form.avatarPath) }}
                </div>
            </div>
        </div>
    </div>

    <h3>Contacts</h3>

    <div data-prototype-container=".contacts-container"
         data-prototype="{{ form_widget(form.contacts.vars.prototype) | e }}">
        <div class="contacts-container">
            {% for contactField in form.contacts %}
            <div data-prototype-line>
                <div class="form-group">
                    {{ form_row(contactField.type) }}
                </div>
                <div class="form-group">
                    {{ form_row(contactField.valeur) }}
                </div>
                <button type="button" class="btn btn-default" data-prototype-button-remove>Supprimer</button>
            </div>
            {% endfor %}
        </div>
        <button type="button" class="btn btn-default" data-prototype-button-add>Ajouter</button>
    </div>

    <h3>Situation professionnelle & disponibilité</h3>

    <div class="form-group">
        {{ form_row(form.situationProfessionnelle) }}
    </div>
    <div class="form-group">
        {{ form_row(form.disponibilite) }}
    </div>

    <div data-container="experience">
        {% for experienceField in form.experiences %}
        <div class="form-group">
            {{ form_row(experienceField.typeContrat) }}
        </div>
        <div class="form-group">
            {{ form_row(experienceField.informationsGenerales.intitulePoste) }}
        </div>
        <div class="form-group">
            {{ form_row(experienceField.informationsGenerales.dateDebut) }}
        </div>
        <div class="form-group">
            {{ form_row(experienceField.informationsGenerales.dateDebut) }}
        </div>
        <div class="form-group">
            {{ form_row(experienceField.informationsGenerales.dateFin) }}
        </div>
        <div class="form-check">
            {{ form_row(experienceField.informationsGenerales.enCours) }}
        </div>
        <div class="form-group">
            {{ form_row(experienceField.entreprise) }}
        </div>
        <div class="form-group">
            {{ form_row(experienceField.ville) }}
        </div>
        {% endfor %}
    </div>

    <div data-container="domaine">
        {% for domaineField in form.domainesCompetence %}
        <div class="form-group">
            {{ form_row(domaineField.nom) }}
        </div>
        <div class="competences">
            <div data-prototype-container=".competences-container"
                 data-prototype="{{ form_widget(domaineField.competences.vars.prototype) | e }}">
                <div class="competences-container">
                    {% for competenceField in domaineField.competences %}
                    <div data-prototype-line>
                        <div class="form-group">
                            {{ form_row(competenceField.nom) }}
                        </div>
                        <div class="form-group">
                            {{ form_row(competenceField.note) }}
                        </div>
                        <button type="button" class="btn btn-default" data-prototype-button-remove>Supprimer</button>
                    </div>
                    {% endfor %}
                </div>
                <button type="button" class="btn btn-default" data-prototype-button-add>Ajouter</button>
            </div>
        </div>
        {% endfor %}
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</div>
