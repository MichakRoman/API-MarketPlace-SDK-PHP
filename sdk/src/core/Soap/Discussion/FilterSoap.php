<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 16:41
 */

namespace Sdk\Soap\Discussion;


use Sdk\Soap\XmlUtils;

class FilterSoap
{

    protected $_BeginCreationDateTAG = 'BeginCreationDate';
    protected $_BeginModificationDateTAG = 'BeginModificationDate';
    protected $_EndCreationDateTAG = 'EndCreationDate';
    protected $_EndModificationDateTAG = 'EndModificationDate';

    protected $_StatusListTAG = 'StatusList';
    protected $_DiscussionStateFilterTAG = 'DiscussionStateFilter';
    protected $_OrderNumberListTAG = 'OrderNumberList';

    private $_xmlns = '';

    protected $_xmlUtil;

    protected $_childrens = "";

    private $_tag = null;

    /**
     * FilterSoap constructor.
     * @param string $xmlns
     * @param $tag
     */
    public function __construct($xmlns = 'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"', $tag)
    {
        $this->_xmlns = $xmlns;
        $this->_xmlUtil = new XmlUtils('');
        $this->_tag = $tag;
    }

    /**
     * @return string
     */
    private function _generateOpeningBalise()
    {
        $inlines = array($this->_xmlns);

        return $this->_xmlUtil->generateOpenBaliseWithInline($this->_tag, $inlines);
    }

    /**
     * @return string
     */
    private function _generateClosingBalise()
    {
        return $this->_xmlUtil->generateCloseBalise($this->_tag);
    }

    /**
     * @param $child
     * @return string
     */
    public function generateEnclosingBalise($child)
    {
        $xml = $this->_generateOpeningBalise();
        $xml .= $child;
        $xml .= $this->_generateClosingBalise();
        return $xml;
    }

    /**
     * @return string
     */
    public function generateEnclosingBaliseWithChildren()
    {
        $xml = $this->_generateOpeningBalise();
        $xml .= $this->_childrens;
        $xml .= $this->_generateClosingBalise();
        return $xml;
    }

    /**
     * Serialize DateTime
     *
     * @param $value
     * @param $tag
     * @return string
     */
    protected function _serializeDate($value, $tag)
    {
        if ($value == null) {
            return $this->_xmlUtil->generateAutoClosingBalise($tag, 'i:nil', 'true');
        }
        return $this->_xmlUtil->generateOpenBalise($tag) . $value . $this->_xmlUtil->generateCloseBalise($tag);
    }
}