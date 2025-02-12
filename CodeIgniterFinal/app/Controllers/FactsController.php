<?php
namespace App\Controllers;
use App\Models\WondersModel;
use App\Models\FactsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class FactsController extends BaseController
{
    public function index() {


        $facts_model = model(FactsModel::class);
        $wonders_model = model(WondersModel::class);

        // AQUÍ HAY UN JOIN DE EJEMPLO

        $data = [
            'facts' => $facts_model->join('7wonders', '7wonders.id=facts.wonder_id')->findAll(),
            'title' => 'Manage Facts',
        ];


        return view('templates/header', $data)
            . view('backend/facts/index')
            . view('templates/footer');
    }

    public function createForm()
    {
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }

        helper('form');

        $wonders_model = model(WondersModel::class);

        if($data['wonders'] = $wonders_model->findAll()){
            return view('templates/header', ['title' => 'Create new fact'])
                .view('backend/facts/create', $data)
                .view('templates/footer');
        }

    }

    public function createFact()
    {

        helper('form');


        $data = $this->request->getPost(['fact_text', 'wonder_id', ]);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'fact_text' => 'required|max_length[255]|min_length[3]',
            'wonder_id' => 'required',
        ])) {
            // The validation fails, so returns the form.
            return $this->createForm();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $facts_model = model(FactsModel::class);


        $facts_model->save([
            'fact_text' => $post['fact_text'],
            'wonder_id'  => $post['wonder_id'],
        ]);

        return redirect()->to(base_url('/admin/facts'));
    }

    public function delete($id)
    {
        if ($id == null){
            throw new PageNotFoundException('Cannot delete the fact');
        }

        $facts_model = model(FactsModel::class);

        if($facts_model->where('fact_id',$id)->find())
        {
            $facts_model->where('fact_id',$id)->delete();
        }else {
            throw new PageNotFoundException('Selected fact does not exist in database');
        }


        return redirect()->to(base_url('admin/facts'));
    }

    public function updateForm($id) {
        $session = session();
        if(empty($session->get['user'])) {
            return redirect()->to(base_url('/admin/facts'));
        }
        helper('form');

        $facts_model = model(FactsModel::class);
        $wonders_model = model(WondersModel::class);

        $data['wonders'] = $wonders_model->findAll();

        $data['fact'] = $facts_model->where(['fact_id' => $id])->first();

        return view('templates/header.php', $data)
            . view('backend/facts/index.php')
            . view('templates/footer.php');

    }

    public function updateFact($id)
    {
        helper('form');


        $data = $this->request->getPost(['fact_text', 'wonder_id', ]);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'fact_text' => 'required|max_length[255]|min_length[3]',
            'wonder_id' => 'required',
        ])) {
            // The validation fails, so returns the form.
            return $this->updateForm();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $facts_model = model(FactsModel::class);


        $facts_model->save([
            'fact_id' => $id,
            'fact_text' => $post['fact_text'],
            'wonder_id'  => $post['wonder_id'],
        ]);

        return redirect()->to(base_url('/admin/facts'));
    }
}