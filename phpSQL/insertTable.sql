INSERT INTO shop (name, address) VALUES
('Tech Store', '123 Tech Lane'),
('Gadget World', '456 Innovation Drive'),
('Home Goods', '789 Cozy St'),
('Super Mart', '321 Market Ave'),
('Fashion Boutique', '654 Style Blvd');

INSERT INTO client (name, phone) VALUES
('Alice Johnson', '+1234567890'),
('Bob Smith', '+1987654321'),
('Charlie Brown', '+1098765432'),
('Diana Prince', '+1201345678'),
('Evan Davis', '+1123456789');


INSERT INTO product (name, price, count, shop_id) VALUES
('Laptop', 999.99, 10, 1),
('Smartphone', 699.49, 20, 1),
('Blender', 59.99, 15, 3),
('T-Shirt', 19.99, 50, 5),
('Headphones', 89.90, 30, 2);


INSERT INTO "order" (created_at, shop_id, client_id) VALUES
('2025-08-01 10:00:00', 1, 1),
('2025-08-02 11:30:00', 2, 2),
('2025-08-03 12:45:00', 3, 3),
('2025-08-04 14:20:00', 1, 4),
('2025-08-05 16:00:00', 5, 5);

INSERT INTO order_product (order_id, product_id, price, quantity) VALUES
(1, 1, 999.99, 1),  -- Laptop
(2, 5, 89.90, 2),   -- Headphones
(3, 3, 59.99, 1),   -- Blender
(4, 2, 699.49, 1),  -- Smartphone
(5, 4, 19.99, 3);   -- T-Shirts

