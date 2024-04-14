@twillBlockTitle('Membru')
@twillBlockIcon('image')
@twillBlockGroup('app')

<x-twill::medias name="1" label="Imagine" />
<x-twill::input name="nume" label="Nume" />
<x-twill::input name="functie" label="Functie" />
<x-twill::input name="descriere" label="Descriere pe scurt(max.100 caractere)" :maxlength="100" />
