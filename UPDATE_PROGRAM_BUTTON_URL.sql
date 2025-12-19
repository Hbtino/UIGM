-- Update program button URL from /dashboard to /program
-- This completes the program detail page implementation

UPDATE landing_contents 
SET button_url = '/program',
    button_text = 'Lihat Semua Program'
WHERE section = 'program';

-- Verify the update
SELECT id, section, title, button_text, button_url, is_active 
FROM landing_contents 
WHERE section = 'program';