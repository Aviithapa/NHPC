<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = "program";
    protected $fillable = ["name", "certificate_name", "code_", "qualification", 'level_id', 'program_duration', 'duration_type', 'program_type', 'vacancy_number', 'exam', 'category_id', 'created_by', 'sub_delete', 'created_date', 'status', 'subject-committee_id'];

    public function getlevel()
    {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function getLevelName()
    {
        if (isset($this->getlevel->name)) {
            return $this->getlevel->name;
        } else {
            return '';
        }
    }
}
