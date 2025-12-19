<?php

namespace App\Controllers;

use App\Libraries\CriteriaDataService;

class CriteriaController extends BaseController
{
    private $criteriaDataService;

    public function __construct()
    {
        $this->criteriaDataService = new CriteriaDataService();
    }

    public function settingInfrastructure()
    {
        try {
            $data = $this->criteriaDataService->mapDashboardData('si');
            
            if (!$data) {
                return view('criteria/error');
            }

            return view('criteria/setting_infrastructure', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading Setting Infrastructure criteria: ' . $e->getMessage());
            return view('criteria/error');
        }
    }

    public function energyClimate()
    {
        try {
            $data = $this->criteriaDataService->mapDashboardData('ec');
            
            if (!$data) {
                return view('criteria/error');
            }

            return view('criteria/energy_climate', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading Energy Climate criteria: ' . $e->getMessage());
            return view('criteria/error');
        }
    }

    public function wasteManagement()
    {
        try {
            $data = $this->criteriaDataService->mapDashboardData('ws');
            
            if (!$data) {
                return view('criteria/error');
            }

            return view('criteria/waste_management', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading Waste Management criteria: ' . $e->getMessage());
            return view('criteria/error');
        }
    }

    public function waterManagement()
    {
        try {
            $data = $this->criteriaDataService->mapDashboardData('wr');
            
            if (!$data) {
                return view('criteria/error');
            }

            return view('criteria/water_management', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading Water Management criteria: ' . $e->getMessage());
            return view('criteria/error');
        }
    }

    public function transportation()
    {
        try {
            $data = $this->criteriaDataService->mapDashboardData('tr');
            
            if (!$data) {
                return view('criteria/error');
            }

            return view('criteria/transportation', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading Transportation criteria: ' . $e->getMessage());
            return view('criteria/error');
        }
    }

    public function educationResearch()
    {
        try {
            $data = $this->criteriaDataService->mapDashboardData('ed');
            
            if (!$data) {
                return view('criteria/error');
            }

            return view('criteria/education_research', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading Education Research criteria: ' . $e->getMessage());
            return view('criteria/error');
        }
    }


}