<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Files;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\MultiSelect;
use A17\Twill\Services\Forms\Fields\Radios;
use A17\Twill\Services\Forms\Fields\Tags;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Options;
use App\Models\Product;
use App\Repositories\CategoryRepository;

class ProductController extends BaseModuleController
{
    protected $moduleName = 'products';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        // $this->setPermalinkBase('');
        $this->withoutLanguageInPermalink();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Tags::make()->label('Categorie *')->required(true)->note('Obligatoriu !')
        );

        $form->add(Medias::make()->name('picture')->label('Imagini (max.10)')->max(10)->required(true)->note('Obligatoriu !'));

        $form->add(
            Wysiwyg::make()->name('description')->label('Descriere')
        );
        $form->add(
            Radios::make()->name('in_stock')->options(
                Options::make([
                    Option::make('1', 'Da'),
                    Option::make('0', 'Nu'),
                ])
        )->label('Produsul este in stoc ?'));
        $form->add(
            Input::make()->name('price')->type('number')->label('price')
        );
        $form->add(
            Input::make()->name('sale_price')->type('number')->label('Pret la reducere')
        );
        $form->add(
            Input::make()->name('stock_quantity')->type('number')->min(1)->label('Cantitate stoc')
        );
        $form->add(
            Input::make()->name('production_code')->label('Cod producator')
        );
        $form->add(
            Radios::make()->name('is_featured')->options(
                Options::make([
                    Option::make('1', 'Da'),
                    Option::make('0', 'Nu'),
                ])
        )->label('Produs recomandat?'));

        $form->add(Files::make()
            ->name('files')
            ->label('Fisiere')->max(5));

        $form->add(Files::make()
            ->name('videos')
            ->label('Video')->max(2)->note('Puteti adauga maxim 2 fisiere de tip mp4, webm, ogg, avi, mov, flv, mkv, wmv, mpeg, mpg, 3gp, asf, m4v sau m2v '));

        // $form->add(
        //     BlockEditor::make()
        // );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('description')->title('Description')
        );

        return $table;
    }

    public function addToCart(Product $product)
{
    // Check if the product is already in the user's cart
    $cartItem = auth()->user()->cart->where('product_id', $product->id)->first();

    if ($cartItem) {
        // Update quantity if the product is already in the cart
        $cartItem->update(['quantity' => $cartItem->quantity + 1]);
    } else {
        // Add the product to the cart
        auth()->user()->cart->create(['product_id' => $product->id, 'quantity' => 1]);
    }
}
}
