#
# RTE Konfiguration Basis Optionen
# Zeile 10: Pfad zur rte.css anpassen !
# weitere Infos: http://typo3.org/extension-manuals/rtehtmlarea/1.4.4/view/5/2/
#


RTE.default {
 
    # CSS-Datei fpr rte, Darstellungen im RTE Editor
    contentCSS = fileadmin/myPath/rte.css
        
    ## Markup options
    enableWordClean = 1
    removeTrailingBR = 1
    removeComments = 1
    removeTags = center, sdfield
    removeTagsAndContents = style,script

    # Dies sind alle zur Verfügung stehende Buttons
    # die mit showButtons hideButtons angezeigt/versteckt werden können
    # showButtons (
    #   class, blockstylelabel, blockstyle, textstylelabel, textstyle,
    #   formatblock, bold, italic, subscript, superscript,
    #   orderedlist, unorderedlist, outdent, indent, textindicator,
    #   insertcharacter, link, table, findreplace, chMode, removeformat, undo, redo, about,
    #   toggleborders, tableproperties,
    #   rowproperties, rowinsertabove, rowinsertunder, rowdelete, rowsplit,
    #   columninsertbefore, columninsertafter, columndelete, columnsplit,
    #   cellproperties, cellinsertbefore, cellinsertafter, celldelete, cellsplit, cellmerge,
    #   hMode, underline, strikethrough, superscript, lefttoright, righttoleft, left, center, right, justifyfull, inserttag,  removeformat, copy, cut, paste
    # )
 
    # Buttons die gezeigt werden
    showButtons (
          bold
        , italic
        , formatblock
        , textstyle
        , textstylelabel
        , blockstyle
        , blockstylelabel
        , underline
        , left
        , center
        , right
        , orderedlist
        , unorderedlist
        , insertcharacter
        , line
        , link
        , image
        , removeformat
        , findreplace
        , insertcharacter
    )
    # Buttons die ausgeblendet werden sollen, damit wird die defualt Einstellung des rte sicher überschrieben
    # show und hide buttons sollten nachher alle buttons aus der Vorgabe enthalten (Zeile 22 ff)
    hideButtons(
          fontstyle
        , fontsize
        , strikethrough
        , lefttoright
        , righttoleft
        , textcolor
        , bgcolor
        , textindicator
        , emoticon
        , user
        , spellcheck
        , chMode
        , inserttag
        , outdent
        , indent
        , justifyfull
        , subscript
        , superscript
        , acronym
        , copy
        , cut
        , paste
        , undo
        , redo
        , showhelp
        , about
        , tableproperties
        , rowproperties
        , rowinsertabove
        , rowinsertunder
        , rowdelete
        , rowsplit
        , columninsertbefore
        , columninsertafter
        , columndelete
        , columnsplit
        , cellproperties
        , cellinsertbefore
        , cellinsertafter
        , celldelete
        , cellsplit
        , cellmerge
        , toggleborders
        , table
    )

    # die Reihenfolge der Buttons im RTE
    toolbarOrder (
        bold, italic, formatblock, linebreak,
        textstyle, textstylelabel, linebreak,
        blockstyle, blockstylelabel, linebreak,
         underline, left, center, right, orderedlist, unorderedlist, insertcharacter, line, link, image, removeformat, findreplace, insertcharacter
    )

    # Einträge im RTE select Feld "Format"
    # zunächst eine Übersicht aller Standard Einträge:
    # address, article, aside, div, footer, header, nav, p,  h1 - h6, pre, blockquote, section, 
    # jetzt all das was wir nicht wollen:
    buttons.formatblock.removeItems (
          address
        , article
        , aside
        , div
        , footer
        , header
        , nav
        , p
        , h5
        , h6
        , pre
        , blockquote
        , section
    )
  
    # Hält die RTE Icons gegroupt zusammen
    keepButtonGroupTogether = 1
 
    # blendet Statusbar in htmlarea aus
    showStatusBar =  0
 
    ## Ergänzt CSS Style für Textausrichtung links - center - rechts für h, p und Tabellen
    inlineStyle.text-alignment (
        p.align-left, h1.align-left, h2.align-left, h3.align-left, h4.align-left, h5.align-left, h6.align-left, td.align-left { text-align: left; }
        p.align-center, h1.align-center, h2.align-center, h3.align-center, h4.align-center, h5.align-center, h6.align-center, td.align-center { text-align: center; }
        p.align-right, h1.align-right, h2.align-right, h3.align-right, h4.align-right, h5.align-right, h6.align-right, td.align-right { text-align: right; }
        )
 
    ## Eigens Stylesheet (für RTE Ansicht) wird nicht vom RTE EXT Stylesheet überschrieben
    ignoreMainStyleOverride = 1
        
    proc {
          # tags die erlaubt / verboten sind
          allowTags (
            , table ,tbody, tr, th, td, 
            , h1, h2, h3, h4, h5, h6
            , div
            , p
            , br
            , span
            , ul, ol, li 
            , re
            , blockquote
            , strong, em, b, i, u, sub, sup, strike
            , a
            , img
            , nobr, hr, tt, q, cite, abbr, acronym, center
          )
          
        denyTags = font
 
          # br wird nicht zu p konvertiert
          dontConvBRtoParagraph = 1
 
          # tags sind erlaubt außerhalt von p, div
          allowTagsOutside = img,hr
 
          # erlaubte attribute in p, div tags
          keepPDIVattribs = align,class,style,id 

          # Eigenen Klassen müssen hier nochmal eingefügt werden
          #allowedClasses = myclass1, myclass2
          #classesParagraph = myclass1, myclass2
 
          # Liste aller Klassen die in die DB geschrieben werden dürfen
          # Eigene Klassen müssen hier angefügt werden!
          allowedClasses (
              external-link, external-link-new-window, internal-link, internal-link-new-window, download, mail,
              align-left, align-center, align-right, author
              )       
 
          # Generelle Einstellungen für den HTML-Parser
          HTMLparser_rte {
 
              # tags die erlaubt/verboten sind
              allowTags < RTE.default.proc.allowTags
              denyTags < RTE.default.proc.denyTags

              # entfernt html-kommentare
              removeComments = 1
 
              # tags die nicht übereinstimmen werden nicht entfernt (protect / 1 / 0)
              keepNonMatchedTags = 0

              # Tags, die nicht richtig verschachtelt sind, werden entfernt
              keepNonMatchedTags = 1
           }
 
 
           # Vom RTE in die Datenbank
           entryHTMLparser_db = 1
           entryHTMLparser_db {
 
              # tags die erlaubt/verboten sind
              allowTags < RTE.default.proc.allowTags
              denyTags < RTE.default.proc.denyTags
 
              # Für diese Tags sind keine Attribute erlaubt
              noAttrib = b, i, u, strike, sub, sup, strong, em, quote, blockquote, cite, tt, br, center
 
              # Diese Tags werden entfernt wenn kein Attribut vorhanden ist
              rmTagIfNoAttrib = span,div,font
 
              # htmlSpecialChars = 1
        
              ## align attribute werden erlaubt
              tags {
                    p.fixAttrib.align.unset >
                    p.allowedAttribs = class,style,align
 
                    div.fixAttrib.align.unset >
 
                    hr.allowedAttribs = class
 
                    # Das <b>-Tag wird durch <strong> ersetzt
                    b.remap = strong
                    i.remap = em
 
                    ## img tags werden erlaubt
                    img >
                }
             }

           # Von der Datenbank in den RTE
           exitHTMLparser_db = 1
           exitHTMLparser_db {
                }
        
     } #end proc
     
    showTagFreeClasses = 1

    # Tags die nicht eingeführt werden dürfen
    hideTags = font
 
    # Tabellen Optionen in der RTE Toolbar
    hideTableOperationsInToolbar = 0
    keepToggleBordersInToolbar = 1
 
    # Tabellen Editierungs-Optionen (cellspacing/ cellpadding / border)
    disableSpacingFieldsetInTableOperations = 1
    disableAlignmentFieldsetInTableOperations=1
    disableColorFieldsetInTableOperations=1
    disableLayoutFieldsetInTableOperations=1
    disableBordersFieldsetInTableOperations=0

} #End RTE.default
   
# Use same processing as on entry to database to clean content pasted into the editor
RTE.default.enableWordClean.HTMLparser < RTE.default.proc.entryHTMLparser_db
 
# FE RTE configuration (htmlArea RTE only)
RTE.default.FE < RTE.default
RTE.default.FE.userElements >
RTE.default.FE.userLinks >
 
# Breite des RTE in Fullscreen-Ansicht
TCEFORM.tt_content.bodytext.RTEfullScreenWidth= 80% 

### add class "testklasse" ##
RTE.default.proc.allowedClasses := addToList(testklasse)
RTE.default.classesLinks := addToList(testklasse)
RTE.default.classesAnchor := addToList(testklasse)
RTE.classesAnchor := addToList(testklasse)

RTE.classesAnchor.testklasse {
class = testklasse
type = page, url, mail, download
titleText = Open Link
}

RTE.classesAnchor.testklasse.titleText = write your own title-text
RTE.classesAnchor.testklasse.altText = here is your alt-text