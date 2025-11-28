-- Update section name from 'kontak' to 'informasi' in landing_contents table
UPDATE landing_contents 
SET section = 'informasi',
    title = 'Informasi',
    updated_at = NOW()
WHERE section = 'kontak';

-- Verify the update
SELECT * FROM landing_contents WHERE section = 'informasi';
