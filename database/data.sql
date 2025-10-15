USE `task-app`;

-- Todos los usuarios tienen la contraseña 123456 (hashed)
INSERT INTO User (name, email, password, active, administrator, created_at, updated_at) VALUES
('Ana López', 'ana.lopez@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 0, NOW(), NOW()),
('Carlos Méndez', 'carlos.mendez@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 1, NOW(), NOW()),
('Beatriz Ramírez', 'beatriz.ramirez@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 0, NOW(), NOW()),
('David Torres', 'david.torres@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 0, NOW(), NOW()),
('Elena Cruz', 'elena.cruz@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 1, NOW(), NOW()),
('Fernando Díaz', 'fernando.diaz@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 0, NOW(), NOW()),
('Gabriela Soto', 'gabriela.soto@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 0, NOW(), NOW()),
('Héctor Morales', 'hector.morales@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 1, NOW(), NOW()),
('Isabel Herrera', 'isabel.herrera@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 0, NOW(), NOW()),
('Jorge Navarro', 'jorge.navarro@example.com', '$2y$10$sqpUjPGjVNAIZ4EUwCBaH.g2xRz9qMsoABOWy1JBMGYOT10u.xSx2', 1, 0, NOW(), NOW());
