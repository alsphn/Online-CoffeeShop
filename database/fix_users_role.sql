-- Add role column to users table if not exists
ALTER TABLE users ADD COLUMN IF NOT EXISTS role ENUM('admin', 'member') DEFAULT 'member' AFTER password;

-- Update existing users to have member role
UPDATE users SET role = 'member' WHERE role IS NULL OR role = '';

-- Create admin user if not exists (update email as needed)
INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES ('Admin', 'admin@coffeeshop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW())
ON DUPLICATE KEY UPDATE role = 'admin';

-- Drop old role_id column if exists
-- ALTER TABLE users DROP COLUMN IF EXISTS role_id;

SELECT 'Database updated successfully!' as message;
