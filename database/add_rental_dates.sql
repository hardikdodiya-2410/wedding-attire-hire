ALTER TABLE `order_detail`
ADD COLUMN `rental_from_date` DATE NULL AFTER `price`,
ADD COLUMN `rental_to_date` DATE NULL AFTER `rental_from_date`;
