@twillBlockTitle('Text Personalizabil')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::wysiwyg type="quill" name="text" label="Text" placeholder="Textul dorit personalizat (inclusiv culori)" :toolbar-options="[
    ['header' => [2, 3, 4, 5, 6, false]],
    ['color' => []],
    ['background' => []],
    'bold',
    'italic',
    'underline',
    'strike',
    ['list' => 'bullet'],
    ['list' => 'ordered'],
    ['script' => 'super'],
    ['script' => 'sub'],
    ['size' => ['small', false, 'large', 'huge']],
    ['indent' => '-1'],
    ['indent' => '+1'],
    ['align' => []],
    ['direction' => 'rtl'],
    'blockquote',
    'code-block',
    'link',
    'clean',
    'table',
]" :editSource="true" />
