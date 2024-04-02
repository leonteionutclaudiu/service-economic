@twillBlockTitle('Membru')
@twillBlockIcon('image')
@twillBlockGroup('app')

<x-twill::medias name="1" label="O imagine cu colegul" />
<x-twill::input name="nume" label="Numele colegului" />
<x-twill::input name="functie" label="Functia colegului" />
<x-twill::input name="descriere" label="Descriere pe scurt a colegului" :maxlength="100" />
