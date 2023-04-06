<?php

namespace App\Http\Controllers;

use App\helper\Language;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use Exception;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected string $method;
    protected string $controller;
    protected bool $IsInit = false;
    protected Language $lang;

    /**
     * Get custom view from resources
     *
     * @param mixed ...$data
     * @return View
     */
    public function view(mixed ...$data):View
    {
        $this->init();
        $data = count($data) ? $data[0] : $data;

        $data['title'] = 'title';
        $data['CSS']   = 'css'.DS.$this->controller.DS.$this->method.'.css';
        $data['js']    = 'js'.DS.$this->controller.DS.$this->method.'.js';

        return view($this->controller.'.'.$this->method,$data);
    }

    /**
     * To Processing application variables
     ** you must call this method before call this->view()
     * @return void
     */
    public function init(): void
    {
        if (!$this->IsInit)
        {
            $path = Route::currentRouteAction();
            $path = explode('@',$path);
            $this->method = $path[1];
            $path = explode('\\',$path[0]);
            $this->controller = $path[count($path)-1];
            $this->controller = str_ireplace('Controller','',$this->controller);
            $this->controller = strtolower($this->controller);

            $this->lang = new Language($this->controller,$this->method);

            $this->IsInit = true;
        }
    }

    /**
     * Handel App Error
     *
     * @param Exception $exception
     * @return array|string
     */
    protected function handleException(Exception $exception): array|string
    {
        if ($exception->getCode() == APP_ERROR)
        {
            $message = $this->lang->text($exception->getMessage());
        }
        else
        {
            $message = $this->lang->text('error');
        }
        //Error recording
        report($exception);

        return $message;
    }

    /**
     * Put error on session
     *
     * @param $message
     * @return void
     */
    public function setSystemMessage($message): void
    {
        session::flash('error' , $message);
    }

    /**
     * Put success massage on session
     *
     * @param $message
     * @return void
     */
    public function success($message): void
    {
        session::flash('success' , $this->lang->text($message));
    }
}
