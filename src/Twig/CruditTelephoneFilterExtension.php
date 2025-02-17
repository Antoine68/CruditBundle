<?php

namespace Lle\CruditBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * This filter allows to format the display of a phone number in 03 88 .. .. ..
 */
class CruditTelephoneFilterExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('telephone', [$this, 'formatTelephone'])
        ];
    }

    public function formatTelephone($telephone)
    {
        $telephone = str_replace(' ', '', $telephone);

        if (strpos($telephone, '+33') === 0) {
            $start = substr($telephone, 0, 3);
            $middle = substr($telephone, -9, 1);
            $end = substr($telephone, 4);

            $formatEnd = wordwrap($end, 2, ' ', true);

            return $start . ' ' . $middle . ' ' . $formatEnd;
        }
        
        if (strlen($telephone) == 10) {
            return wordwrap($telephone, 2, ' ', true);
        }

        return $telephone;
    }
}
