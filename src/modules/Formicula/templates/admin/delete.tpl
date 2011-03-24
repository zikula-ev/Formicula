{include file='admin/header.tpl'}

<h2>{gt text="Delete contact"}</h2>
<p class="z-warningmsg">{gt text="Do you really want to delete this contact?"}</p>
<form class="z-form" action="{modurl modname=Formicula type=admin func=delete}" method="post">
    <fieldset>
        <legend>{gt text='Confirmation prompt'}</legend>
        <input type="hidden" name="cid" value="{$contact.cid}" />
        <input type="hidden" name="authid" value="{insert name="generateauthkey" module="Formicula"}" />
        <div class="z-formrow">
            <span class="z-label">{gt text="Contact name"}</span>
            <span>{$contact.name|safetext}</span>
        </div>
        <div class="z-formrow">
            <span class="z-label">{gt text="E-Mail"}</span>
            <span>{$contact.email|safetext}</span>
        </div>

    </fieldset>

    <div class="z-formbuttons z-buttons">
        {button class="z-btgreen" src='button_ok.gif' name='confirmation' value='confirmation' set='icons/extrasmall' __alt='Delete' __title='Delete' __text='Delete'}
        <a class="z-btred" href="{modurl modname='Formicula' type='Admin' func='view'}">{img modname='core' src='button_cancel.gif' set='icons/extrasmall' __alt='Cancel'  __title='Cancel'} {gt text="Cancel"}</a>
    </div>
</form>

{include file='admin/footer.tpl'}