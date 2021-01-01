<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


class AdminLteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            
            /** Methods od BuildingMenu $event
             * add(...$newItems)
             * addAfter($itemKey, ...$newItems)
             * addBefore($itemKey, ...$newItems)
             * addIn($itemKey, ...$newItems)
             * remove($itemKey)
             * itemKeyExists($itemKey)
             */ 
            
            $new_items = [
                // ['header' => 'Export'],
                [
                    'text'    => 'Upload New File',                 
                    'icon'    => 'fas fa-fw fa-file-upload',   
                    'classes' => 'text-success',
                    'route'   => 'files.create',
                    'topnav'  => true,
                ],
        
                // ['header' => 'Action'],
                // [
                //     'text'       => 'Logout',                 
                //     'icon'       => 'nav-icon far text-danger fas fa-sign-out-alt',   
                //     'icon_color' => 'red',
                //     'url'        => '/logout',
                //     // 'topnav'     => true,
                // ],
                [
                    'text'    => 'Export & Import',
                    'icon'    => 'fas fa-fw fa-exchange-alt',  
                    'submenu' => [
                        [
                            'text'    => 'Users',
                            'can'     => 'users.*',
                            'icon'    => 'fas fa-fw fa-users',  
                            'submenu' => [
                                [
                                    'text'   => 'Export Users',
                                    'route'  => 'users.export',
                                    'icon'   => 'fas fa-fw fa-download',
                                ],
                                [
                                    'text'   => 'Import Users',
                                    'route'  => 'users.import',
                                    'icon'   => 'fas fa-fw fa-file-import',
                                ],
                            ],
                        ],[
                            'text'    => 'Files',
                            'icon'    => 'fas fa-fw fa-file-excel',
                            'submenu' => [
                                [
                                    'text'   => 'Export Files',
                                    'route'  => 'files.export',
                                    'icon'   => 'fas fa-fw fa-download',
                                ],
                                [
                                    'text'   => 'Import Files',
                                    'route'  => 'files.import',
                                    'icon'   => 'fas fa-fw fa-file-import',
                                ],
                            ],
                        ],
                    ],    
                ],
            ];
            $event->menu->addAfter('pages', ...$new_items);

            // $event->menu->add('MAIN NAVIGATION');
            // $event->menu->add([
            //     'text' => 'Blog',
            //     'url' => 'admin/blog',
            // ]);
            $event->menu->addIn('pages', [
                    'text'    => 'Manage Users',     
                    'icon'    => 'fas fa-fw fa-users',  
                    'can'     => 'users.*',                
                    'color'   => 'success',
                    'route'   => 'users.index',
                ], 
                [
                    'text'    => 'Manage Files',
                    'icon'    => 'fas fa-fw fa-file-alt',  
                    'route'   => 'files.index',
                    'can'     => 'files.*',        
                ],
            );

            
        });
    }
}
