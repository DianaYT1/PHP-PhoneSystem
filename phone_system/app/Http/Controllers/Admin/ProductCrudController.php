<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Validation\Rule;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    
    private function getFieldsData($show = FALSE) {
        return [
            [
                'name'=> 'name',
                'label' => 'Name',
                'type'=> 'text'
            ],
            [
                'name'=> 'model',
                'label' => 'Model',
                'type'=> 'text'
            ],
            [
                'name'=> 'producer',
                'label' => 'Producer',
                'type'=> 'text',
                'validation' => 'required', 
            ],
            [
                'name'=> 'year_of_release',
                'label' => 'Year of release',
                'type' => 'integer',
                'attributes' => [
                    'step' => '1',
                    'min' => '1876', 
                    'max' => '2023',
                ],
                'validation' => 'required|integer|min:1876|max:2023',
            ],
           /* [
                'name' => 'content',
                'label' => 'Content',
                'type' => ('text')
            ],*/
           /* [    // SelectMultiple = n-n relationship (with pivot table)
                'label'     => "Tags",
                'type'      => ($show ? "select": 'select_multiple'),
                'name'      => 'tags', // the method that defines the relationship in your Model
// optional
                'entity'    => 'tags', // the method that defines the relationship in your Model
                'model'     => "App\Models\Tag", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            ],*/
            
          [
                'label' => "Product Image",
                'name' => "image",
                'type' => ($show ? 'view' : 'upload'),
                'view' => 'partials/image',
                'upload' => true,
            ]
        ];
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {

        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');

        $this->crud->addFields($this->getFieldsData());
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(TRUE));

       CRUD::column('status')->wrapper([
        'class'=> function($crud,$column,$entry){
            return match ($entry->status) {
                'DRAFT' => 'badge bg-warning',
                default=> 'badge bg-success',
            };
        },
     ]);
     $selectedModel = request()->input('model');

     // Apply the filter manually if it has been submitted
     if ($selectedModel) {
         $this->crud->addClause('where', 'model', $selectedModel);
     }
    }

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */


    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->addField([
            'name' => 'year_of_release',
            'label' => 'Year of release',
            'type' => 'number',
            'attributes' => [
                'step' => '1',
                'min' => '1876',
                'max' => '2023', 
            'validation' => 'required|integer|min:1876|max:2023',
            ],
        ]);

    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

        $this->crud->addField([
            'name' => 'year_of_release',
            'label' => 'Year of release',
            'type' => 'number',
            'attributes' => [
                'step' => '1',
                'min' => '1876',
                'max' => '2023', 
            ],
            'validation' => [
                Rule::requiredIf(!$this->crud->getRequest()->has('status') || $this->crud->getRequest()->input('status') !== 'DRAFT'),
                'integer',
                'min:1876',
                'max:2023',
            ],
        ]);
    }

    protected function setupShowOperation()
    {
        // by default the Show operation will try to show all columns in the db table,
        // but we can easily take over, and have full control of what columns are shown,
        // by changing this config for the Show operation
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(TRUE));
    }

}