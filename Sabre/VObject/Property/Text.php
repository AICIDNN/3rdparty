<?php

namespace Sabre\VObject\Property;

use
    Sabre\VObject\Property,
    Sabre\VObject\Parser\MimeDir;

/**
 * Text property
 *
 * This object represents TEXT values.
 *
 * @copyright Copyright (C) 2007-2013 fruux GmbH. All rights reserved.
 * @author Evert Pot (http://evertpot.com/)
 * @license http://code.google.com/p/sabredav/wiki/License Modified BSD License
 */
class Text extends Property {

    /**
     * Sets a raw value coming from a mimedir (iCalendar/vCard) file.
     *
     * This has been 'unfolded', so only 1 line will be passed. Unescaping is
     * not yet done, but parameters are not included.
     *
     * @param string $val
     * @return void
     */
    public function setRawMimeDirValue($val) {

        $this->setValue(MimeDir::unescapeValue($val, $this->delimiter));

    }

    /**
     * Returns a raw mime-dir representation of the value.
     *
     * @return string
     */
    public function getRawMimeDirValue() {

        $val = $this->getParts();

        foreach($val as &$item) {

            $item = strtr($item, array(
                '\\' => '\\\\',
                ';'  => '\;',
                ','  => '\,',
                "\n" => '\n',
            ));

        }

        return implode($this->delimiter, $val);

    }

}
