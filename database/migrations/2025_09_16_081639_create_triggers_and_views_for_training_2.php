<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggersAndViewsForTraining2 extends Migration
{
    public function up()
    {
        // safety: drop first
        DB::unprepared('DROP TRIGGER IF EXISTS trg_insert_hari_ajar;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_delete_hari_ajar;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_update_training_dates;');
        DB::unprepared('DROP VIEW IF EXISTS v_detail_hari_ajar;');
        DB::unprepared('DROP VIEW IF EXISTS v_rekap_hari_ajar;');

        // AFTER INSERT on pivot -> add days
        DB::unprepared(<<<'SQL'
CREATE TRIGGER trg_insert_hari_ajar
AFTER INSERT ON training_instructors
FOR EACH ROW
BEGIN
    DECLARE durasi INT;
    SELECT DATEDIFF(tanggal_selesai, tanggal_mulai) + 1 INTO durasi
    FROM trainings WHERE id = NEW.training_id;

    IF durasi IS NULL THEN SET durasi = 0; END IF;
    UPDATE instructors SET total_hari_ajar = total_hari_ajar + durasi WHERE id = NEW.instructor_id;
END;
SQL
        );

        // AFTER DELETE on pivot -> subtract days
        DB::unprepared(<<<'SQL'
CREATE TRIGGER trg_delete_hari_ajar
AFTER DELETE ON training_instructors
FOR EACH ROW
BEGIN
    DECLARE durasi INT;
    SELECT DATEDIFF(tanggal_selesai, tanggal_mulai) + 1 INTO durasi
    FROM trainings WHERE id = OLD.training_id;

    IF durasi IS NULL THEN SET durasi = 0; END IF;
    UPDATE instructors SET total_hari_ajar = total_hari_ajar - durasi WHERE id = OLD.instructor_id;
END;
SQL
        );

        // AFTER UPDATE on trainings -> adjust all related instructors
        DB::unprepared(<<<'SQL'
CREATE TRIGGER trg_update_training_dates
AFTER UPDATE ON trainings
FOR EACH ROW
BEGIN
    DECLARE durasi_lama INT;
    DECLARE durasi_baru INT;

    SET durasi_lama = DATEDIFF(OLD.tanggal_selesai, OLD.tanggal_mulai) + 1;
    SET durasi_baru = DATEDIFF(NEW.tanggal_selesai, NEW.tanggal_mulai) + 1;

    IF durasi_lama IS NULL THEN SET durasi_lama = 0; END IF;
    IF durasi_baru IS NULL THEN SET durasi_baru = 0; END IF;

    IF durasi_baru != durasi_lama THEN
        UPDATE instructors i
        JOIN training_instructors ti ON i.id = ti.instructor_id
        SET i.total_hari_ajar = i.total_hari_ajar - durasi_lama + durasi_baru
        WHERE ti.training_id = NEW.id;
    END IF;
END;
SQL
        );

        // view detail
        DB::unprepared(<<<'SQL'
CREATE OR REPLACE VIEW v_detail_hari_ajar AS
SELECT
  i.id AS instructor_id,
  i.nama AS nama_instructor,
  t.id AS training_id,
  t.nama_training,
  t.tanggal_mulai,
  t.tanggal_selesai,
  (DATEDIFF(t.tanggal_selesai, t.tanggal_mulai) + 1) AS durasi_hari,
  i.total_hari_ajar
FROM instructors i
JOIN training_instructors ti ON i.id = ti.instructor_id
JOIN trainings t ON t.id = ti.training_id;
SQL
        );

        // view rekap
        DB::unprepared(<<<'SQL'
CREATE OR REPLACE VIEW v_rekap_hari_ajar AS
SELECT
  i.id AS instructor_id,
  i.nama AS nama_instructor,
  COALESCE(SUM(DATEDIFF(t.tanggal_selesai, t.tanggal_mulai) + 1),0) AS total_hari_dihitung,
  i.total_hari_ajar AS total_hari_ajar_tersimpan
FROM instructors i
LEFT JOIN training_instructors ti ON i.id = ti.instructor_id
LEFT JOIN trainings t ON t.id = ti.training_id
GROUP BY i.id, i.nama, i.total_hari_ajar;
SQL
        );
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_insert_hari_ajar;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_delete_hari_ajar;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_update_training_dates;');
        DB::unprepared('DROP VIEW IF EXISTS v_detail_hari_ajar;');
        DB::unprepared('DROP VIEW IF EXISTS v_rekap_hari_ajar;');
    }
}

