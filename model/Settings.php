<?php
class Settings {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllSettings() {
        $stmt = $this->pdo->query("SELECT setting_key, setting_value FROM store_settings");
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function getSetting($key) {
        $stmt = $this->pdo->prepare("SELECT setting_value FROM store_settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        return $stmt->fetchColumn();
    }

    public function updateSetting($key, $value, $userId) {
        $stmt = $this->pdo->prepare("
            INSERT INTO store_settings (setting_key, setting_value, updated_at, updated_by) 
            VALUES (:key, :value, NOW(), :userId)
            ON DUPLICATE KEY UPDATE 
                setting_value = VALUES(setting_value),
                updated_at = VALUES(updated_at),
                updated_by = VALUES(updated_by)
        ");
        $stmt->execute([
            'key' => $key,
            'value' => $value,
            'userId' => $userId
        ]);
    }
}