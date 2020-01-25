<?php
 
namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;
 
class Donasi extends Model
{


	protected $table = "donasi";


    /**
     * Fillable attribute.
     *
     * @var array
     */
    protected $fillable = [
        'jumlah_dana',
        'komentar',
        'anonim',
        'id_user',
        'id_galang_dana',
        
    ];
 
    /**
     * Set status to Pending
     *
     * @return void
     */
    public function setPending()
    {
        $this->attributes['status_dana'] = 'pending';
        self::save();
    }
 
    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['status_dana'] = 'success';
        self::save();
    }
 
    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['status_dana'] = 'failed';
        self::save();
    }
 
    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['status_dana'] = 'expired';
        self::save();
    }
}