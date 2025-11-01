-- Fix suggestions status column
ALTER TABLE `suggestions` MODIFY COLUMN `status` VARCHAR(50) DEFAULT 'pending';
