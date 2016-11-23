<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use NukaCode\Menu\DropDown;
use NukaCode\Menu\Link;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $this->generateLeftMenu();
        $this->generateRightMenu();
    }

    /**
     * Adds items to the menu that appears on the left side of the main menu.
     */
    private function generateLeftMenu()
    {
        $leftMenu = \Menu::getMenu('leftMenu');

        $leftMenu->link('manage', function (Link $link) {
            $link->name = 'Manage';
            $link->url  = route('administrating.dashboard');
        });

        $leftMenu->dropDown('donation', 'Donations', function (DropDown $dropDown) {
            $dropDown->link('donation_index', function (Link $link) {
                $link->name = 'Donations';
                $link->url  = route('donation.index');
            });
            $dropDown->link('donation_search', function (Link $link) {
                $link->name = 'Donation Bulk Edit';
                $link->url  = route('donation.search');
            });
        });
    
        $leftMenu->dropDown('stream-labs', 'Stream Labs', function (DropDown $dropDown) {
            $dropDown->link('stream-labs_token', function (Link $link) {
                $link->name = 'Tokens';
                $link->url  = route('stream-labs.token.index');
            });
            $dropDown->link('stream-labs_alerts', function (Link $link) {
                $link->name = 'Alerts';
                $link->url  = route('stream-labs.alerts.index');
            });
        });

        $leftMenu->dropDown('overlay', 'Overlay', function (DropDown $dropDown) {
            $dropDown->link('overlay_main', function (Link $link) {
                $link->name = 'Overlay';
                $link->url  = route('administrating.overlay');
            });
            $dropDown->link('overlay_bottom', function (Link $link) {
                $link->name = 'Overlay Bottom';
                $link->url  = route('administrating.overlay.bottom');
            });
            $dropDown->link('overlay_right', function (Link $link) {
                $link->name = 'Overlay Right';
                $link->url  = route('administrating.overlay.right');
            });
            $dropDown->link('overlay_horizontal', function (Link $link) {
                $link->name = 'Overlay Horizontal';
                $link->url  = route('administrating.overlay.horizontal');
            });
            $dropDown->link('overlay_vertical', function (Link $link) {
                $link->name = 'Overlay Vertical';
                $link->url  = route('administrating.overlay.vertical');
            });
            $dropDown->link('overlay_total', function (Link $link) {
                $link->name = 'Overlay Total';
                $link->url  = route('administrating.overlay.total');
            });
        });

        $leftMenu->link('assets', function (Link $link) {
            $link->name = 'Assets';
            $link->url  = route('administrating.asset');
        });

        $leftMenu->link('spreadsheets', function (Link $link) {
            $link->name = 'Spreadsheets';
            $link->url  = null;
        });
    }

    /**
     * Adds items to the menu that appears on the right side of the main menu.
     */
    private function generateRightMenu()
    {
        $rightMenu = \Menu::getMenu('rightMenu');
    }
}
