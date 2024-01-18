@twillBlockTitle('Adaugare job')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::input name="title" label="Post" placeholder="ex. Mecanic Auto" :note="twillTrans('Este recomandat a se utiliza acest block doar pe pagina de cariera')"/>

<x-twill::wysiwyg name="job" label="Descriere job" placeholder="Text" :toolbar-options="[
    ['header' => [2, 3, 4, 5, 6, false]],
    'bold',
    'italic',
    'underline',
    'strike',
    'blockquote',
    'code-block',
    'ordered',
    'bullet',
    'hr',
    'code',
    'link',
    'clean',
    'table',
]" :note="twillTrans('Este recomandat a se utiliza acest block doar pe pagina de cariera')" />
