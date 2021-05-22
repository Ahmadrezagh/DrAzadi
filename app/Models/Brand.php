<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function content()
    {
        return $this->belongsToMany(Content::class);
    }

    public static function setBrands()
    {
        $brands = [
        'Adobe',
        'AnyDesk',
        'Apache',
        'Apple',
        'Asterisk',
        'Atlassian',
        'Avaya',
        'Avira',
        'BankIT',
        'Bind',
        'Bitdefender',
        'Canon',
        'CentOS',
        'Checkpoint',
        'Cisco',
        'Citrix',
        'Cpanel',
        'Cyberoam',
        'Debian',
        'Dell',
        'Diebold Nixdorf',
        'Dlink',
        'Docker',
        'DotNetNuke',
        'EMC',
        'ESET',
        'F5',
        'Fedoraproject',
        'Fortinet',
        'FreeBSD',
        'F-secure',
        'Google',
        'GRG',
        'HP',
        'Huawei',
        'IBM',
        'Ingenico',
        'Intel',
        'Issabel',
        'Java',
        'Jenkins',
        'Jetbrains',
        'Joomla',
        'Juniper',
        'Kaspersky',
        'Kayako',
        'Kerio',
        'Kubernetes',
        'Linux',
        'Mcafee',
        'Microsoft',
        'Mikrotik',
        'Mongodb',
        'Mozilla',
        'Mysql',
        'NCR',
        'NginX',
        'Norton',
        'Nvidia',
        'Omron',
        'Opensuse',
        'Oracle',
        'OTRS',
        'pfSense',
        'PHP',
        'PostgreSQL',
        'Prometheus',
        'PRTG',
        'Python',
        'Qemu',
        'QNAP',
        'Qualcomm',
        'Redhat',
        'Redis',
        'RTIR',
        'Samsung',
        'SAP',
        'Schneider',
        'Solaris',
        'Solarwinds',
        'Sonicwall',
        'Sophos',
        'Splunk',
        'Symantec',
        'TeamViewer',
        'Tp-link',
        'Ubuntu',
        'Verifone',
        'Vmware',
        'Wincor',
        'Wireshark',
        'Wordpress',
        'Zabbix',
        'Zohocorp'
    ];
        foreach ($brands as $brand)
        {
            Brand::create([
                'name' => $brand
            ]);
        }

    }

}
