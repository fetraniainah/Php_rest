<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Skills;
use Exception;

class SkillsController extends Controller {
    public function index() {
        $skill = new Skills();
        $skills = $skill->getAll();
        $this->jsonResponse($skills);
    }

    public function show($id) {
        $skill = new Skills();
        $skillData = $skill->get($id);
        if (!$skillData) {
            $this->jsonResponse(['error' => 'Skill not found'], 404);
            return;
        }
        $this->jsonResponse($skillData);
    }

    public function store() {
        $skill = new Skills();
        $data = $this->content();
        $newSkill = [
            'title' => $data["title"],
            'link' => $data["link"],
            'details' => $data["details"],
            'image_uri' => $data["image_uri"]
        ];
        try {
            $skill->insert($newSkill);
            $this->jsonResponse(['message' => 'Skill created']);
        } catch(Exception $e) {
            $this->jsonResponse(['error' => 'Failed to create skill'], 400);
        }
    }

    public function update($id) {
        $skill = new Skills();
        $data = $this->content();
        $updatedSkill = [
            'title' => $data["title"],
            'link' => $data["link"],
            'details' => $data["details"],
            'image_uri' => $data["image_uri"]
        ];
        try {
            $skill->update($id, $updatedSkill);
            $this->jsonResponse(['message' => 'Skill updated']);
        } catch(Exception $e) {
            $this->jsonResponse(['error' => 'Failed to update skill'], 400);
        }
    }

    public function destroy($id) {
        $skill = new Skills();
        try {
            $skill->delete($id);
            $this->jsonResponse(['message' => 'Skill deleted']);
        } catch(Exception $e) {
            $this->jsonResponse(['error' => 'Failed to delete skill'], 400);
        }
    }
}
?>