-- Таблица магазинов
CREATE TABLE shop (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    address TEXT NOT NULL
);

-- Таблица клиентов
CREATE TABLE client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    phone TEXT NOT NULL
);

-- Таблица продуктов
CREATE TABLE product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    count INTEGER NOT NULL,
    shop_id INTEGER NOT NULL,
    FOREIGN KEY (shop_id) REFERENCES shop(id)
);

-- Таблица заказов
CREATE TABLE "order" (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    created_at TEXT NOT NULL,
    shop_id INTEGER NOT NULL,
    client_id INTEGER NOT NULL,
    FOREIGN KEY (shop_id) REFERENCES shop(id),
    FOREIGN KEY (client_id) REFERENCES client(id)
);

-- Таблица соответствий заказов и продуктов
CREATE TABLE order_product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,
    FOREIGN KEY (order_id) REFERENCES "order"(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);

