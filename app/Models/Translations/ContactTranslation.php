<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\Contact;

class ContactTranslation extends Model
{
    protected $baseModuleModel = Contact::class;
}
