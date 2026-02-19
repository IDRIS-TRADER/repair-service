INSERT INTO users (name, role) VALUES
('dispatcher', 'dispatcher'),
('sasha', 'master'),
('petya', 'master');

INSERT INTO requests (clientName, phone, address, problemText, status, createdAt, updatedAt)
VALUES
('Иван', '111111', 'Москва', 'Не работает кран', 'new', NOW(), NOW()),
('Мария', '222222', 'СПб', 'Сломалась розетка', 'assigned', NOW(), NOW()),
('Алексей', '333333', 'Казань', 'Протекает труба', 'in_progress', NOW(), NOW());
