<?php

namespace App\Http\Livewire;

use App\CPU\Images;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryForm extends Component
{
    public $name;
    public $slug;
    public $icon;
    public $header;
    public $short_description;
    public $site_title;
    public $description;
    public $meta_title;
    public $meta_keyword;
    public $meta_description;
    public $meta_article_tag;
    public $meta_script_tag;
    public $status = 'active';
    public $is_featured = 0;
    public $photo;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'icon' => 'required|string',
        'header' => 'required|string|max:255',
        'short_description' => 'required|string',
        'site_title' => 'required|string|max:255',
        'description' => 'required|string',
        'meta_title' => 'required|string|max:255',
        'meta_keyword' => 'required|string',
        'meta_description' => 'required|string',
        'meta_article_tag' => 'nullable|string',
        'meta_script_tag' => 'nullable|string',
        'status' => 'required|in:active,inactive',
        'is_featured' => 'required|boolean',
        'photo' => 'nullable|image|max:2048',
    ];

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function store()
    {
        $this->validate();

        if ($this->categoryRepository->checkSlugExists($this->slug)) {
            session()->flash('message', 'Slug already exists. Please change the name.');
            return;
        }

        $category = $this->categoryRepository->store([
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'header' => $this->header,
            'short_description' => $this->short_description,
            'site_title' => $this->site_title,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_keyword' => $this->meta_keyword,
            'meta_description' => $this->meta_description,
            'meta_article_tag' => $this->meta_article_tag,
            'meta_script_tag' => $this->meta_script_tag,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
            'photo' => $this->photo ? Images::upload('categories',$this->photo) : null,
        ]);

        session()->flash('message', 'Category created successfully!');
        $this->reset();
    }

    public function render()
    {
        Log::info('CategoryForm render method called');
        return view('livewire.category-form');
    }
}
