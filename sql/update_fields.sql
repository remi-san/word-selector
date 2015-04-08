-- Delete letter_details for table
delete from words.letter_details where table_name = 'en';

-- Update word length
update words.en set len = length(word);

-- Identify letters in words
insert into
  words.letter_details (table_name, word_id, letter, occurences)
select
  'en',
  id,
  letter,
  count(letter)
from (
       select
         w.id,
         regexp_split_to_table(w.word,'') as letter
       from
         words.en w
     ) as letters
where
  letter <> ' '
group by id, letter
order by id, letter;

-- Update nb letters in words table
update words.en w
set letters_nb = nb_letters.cl
from (
	select word_id wid, count(letter) as cl
	from words.letter_details ld
	where table_name = 'en'
	group by word_id
) as nb_letters
where w.id = nb_letters.wid;

-- Update complexity
update words.en
set complexity = ((letters_nb::numeric*letters_nb::numeric*letters_nb::numeric) / (len::numeric * len::numeric))::numeric;
