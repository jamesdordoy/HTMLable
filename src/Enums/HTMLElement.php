<?php

namespace JamesDordoy\HTMLable\Enums;

enum HtmlElement: string
{
    // Inline elements
    case A = 'a';
    case ABBR = 'abbr';
    case ACRONYM = 'acronym'; // Deprecated
    case AUDIO = 'audio';
    case B = 'b';
    case BDI = 'bdi';
    case BDO = 'bdo';
    case BIG = 'big'; // Deprecated
    case BR = 'br';
    case BUTTON = 'button';
    case CITE = 'cite';
    case CODE = 'code';
    case DATA = 'data';
    case DFN = 'dfn';
    case EM = 'em';
    case I = 'i';
    case IFRAME = 'iframe';
    case IMG = 'img'; // Self-closing
    case INPUT = 'input'; // Self-closing
    case KBD = 'kbd';
    case LABEL = 'label';
    case MAP = 'map';
    case MARK = 'mark';
    case METER = 'meter';
    case OBJECT = 'object';
    case OUTPUT = 'output';
    case PROGRESS = 'progress';
    case Q = 'q';
    case SAMP = 'samp';
    case SCRIPT = 'script';
    case SELECT = 'select';
    case SMALL = 'small';
    case SPAN = 'span';
    case STRONG = 'strong';
    case SUB = 'sub';
    case SUP = 'sup';
    case TEXTAREA = 'textarea';
    case TIME = 'time';
    case TT = 'tt'; // Deprecated
    case VAR = 'var';
    case VIDEO = 'video';

    // Block elements
    case ADDRESS = 'address';
    case ARTICLE = 'article';
    case ASIDE = 'aside';
    case BLOCKQUOTE = 'blockquote';
    case CANVAS = 'canvas';
    case CAPTION = 'caption';
    case DD = 'dd';
    case DETAILS = 'details';
    case DIALOG = 'dialog';
    case DIV = 'div';
    case DL = 'dl';
    case DT = 'dt';
    case FIELDSET = 'fieldset';
    case FIGCAPTION = 'figcaption';
    case FIGURE = 'figure';
    case FOOTER = 'footer';
    case FORM = 'form';
    case H1 = 'h1';
    case H2 = 'h2';
    case H3 = 'h3';
    case H4 = 'h4';
    case H5 = 'h5';
    case H6 = 'h6';
    case HEADER = 'header';
    case HR = 'hr'; // Self-closing
    case LI = 'li';
    case MAIN = 'main';
    case MENU = 'menu';
    case NAV = 'nav';
    case OL = 'ol';
    case P = 'p';
    case PRE = 'pre';
    case SECTION = 'section';
    case SUMMARY = 'summary';
    case TABLE = 'table';
    case UL = 'ul';

    // Self-closing elements
    case AREA = 'area';
    case BASE = 'base';
    case COL = 'col';
    case EMBED = 'embed';
    case KEYGEN = 'keygen'; // Deprecated
    case LINK = 'link';
    case META = 'meta';
    case PARAM = 'param';
    case SOURCE = 'source';
    case TRACK = 'track';
    case WBR = 'wbr';

    /**
     * Returns an array of all HTML elements.
     */
    public static function allElements(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Returns an array of all inline elements.
     */
    public static function getInlineElements(): array
    {
        return [
            self::A,
            self::ABBR,
            self::ACRONYM,
            self::AUDIO,
            self::B,
            self::BDI,
            self::BDO,
            self::BIG,
            self::BR,
            self::BUTTON,
            self::CITE,
            self::CODE,
            self::DATA,
            self::DFN,
            self::EM,
            self::I,
            self::IFRAME,
            self::IMG,
            self::INPUT,
            self::KBD,
            self::LABEL,
            self::MAP,
            self::MARK,
            self::METER,
            self::OBJECT,
            self::OUTPUT,
            self::PROGRESS,
            self::Q,
            self::SAMP,
            self::SCRIPT,
            self::SELECT,
            self::SMALL,
            self::SPAN,
            self::STRONG,
            self::SUB,
            self::SUP,
            self::TEXTAREA,
            self::TIME,
            self::TT,
            self::VAR,
            self::VIDEO,
        ];
    }

    /**
     * Returns an array of all block elements.
     */
    public static function getBlockElements(): array
    {
        return [
            self::ADDRESS,
            self::ARTICLE,
            self::ASIDE,
            self::BLOCKQUOTE,
            self::CANVAS,
            self::CAPTION,
            self::DD,
            self::DETAILS,
            self::DIALOG,
            self::DIV,
            self::DL,
            self::DT,
            self::FIELDSET,
            self::FIGCAPTION,
            self::FIGURE,
            self::FOOTER,
            self::FORM,
            self::H1,
            self::H2,
            self::H3,
            self::H4,
            self::H5,
            self::H6,
            self::HEADER,
            self::HR,
            self::LI,
            self::MAIN,
            self::MENU,
            self::NAV,
            self::OL,
            self::P,
            self::PRE,
            self::SECTION,
            self::SUMMARY,
            self::TABLE,
            self::UL,
        ];
    }

    /**
     * Returns an array of all self-closing elements.
     */
    public static function getSelfClosingElements(): array
    {
        return [
            self::AREA->value,
            self::BASE->value,
            self::BR->value,
            self::COL->value,
            self::EMBED->value,
            self::HR->value,
            self::IMG->value,
            self::INPUT->value,
            self::KEYGEN->value,
            self::LINK->value,
            self::META->value,
            self::PARAM->value,
            self::SOURCE->value,
            self::TRACK->value,
            self::WBR->value,
        ];
    }

    /**
     * Returns an array of all elements that have a src attribute.
     */
    public static function getElementsWithSrcAttribute(): array
    {
        return [
            self::AUDIO->value,
            self::EMBED->value,
            self::IFRAME->value,
            self::IMG->value,
            self::INPUT->value,
            self::SCRIPT->value,
            self::SOURCE->value,
            self::TRACK->value,
            self::VIDEO->value,
        ];
    }

    /**
     * Determine the category of the given element.
     */
    public static function getCategory(HtmlElement $element): string
    {
        if (in_array($element, self::getInlineElements())) {
            return 'inline';
        }

        if (in_array($element, self::getBlockElements())) {
            return 'block';
        }

        if (in_array($element, self::getSelfClosingElements())) {
            return 'self-closing';
        }

        return 'unknown';
    }

    /**
     * Returns an array of all deprecated elements.
     */
    public static function getDeprecatedElements(): array
    {
        return [
            self::ACRONYM->value,
            self::BIG->value,
            self::KEYGEN->value,
            self::TT->value,
        ];
    }
}
