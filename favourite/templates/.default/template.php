<? if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die(); ?>

<? if ( $arResult['message'] ) { ?>
<div class="alert alert-<?=$arResult['message_type']?>" role="alert"><?=$arResult['message']?></div>
<? } ?>

<div id="user_list">

	<nav class="navbar navbar-default">

		<form id="search_form" class="navbar-form navbar-left">
			
			<input type="hidden" name="sortby" value="<?=( isset( $arResult['order']['ID'] ) )? 'ID' : 'NAME' ?>">
			<input type="hidden" name="sort" value="<?=current( $arResult['order'] )?>">
			
			<div class="form-group">
			  <input type="text" name="search" class="form-control" value="<?=$arResult['search_string']?>" placeholder="поиск по имени">
			</div>
			<button type="submit" class="btn btn-success">Искать</button>
			<button id="search_clear" class="btn btn-default">Очистить</button>
			
		</form>
		
	</nav>
	
	<? if ( count( $arResult['users'] ) == 0 ) { ?>
	<div class="alert alert-info" role="alert">Не найдено ни одной записи</div>
	<? } else { ?>
	<table id="user_list_table" class="table table-striped">

		<thead>
			<th><a href="#" data-sortby="ID" data-sort="<?=( current( $arResult['order'] ) == 'ASC' && isset( $arResult['order']['ID'] ) )? 'DESC' : 'ASC' ?>">ID
			<? if ( isset( $arResult['order']['ID'] ) ) { ?>
			<span class="glyphicon glyphicon glyphicon glyphicon-sort-by-order<?=( $arResult['order']['ID'] == 'DESC' )? '-alt' : ''?>" aria-hidden="true"></span>
			<? } ?>
			</a>
			</a></th>
			<th colspan="2"><a href="#" data-sortby="NAME" data-sort="<?=( current( $arResult['order'] ) == 'ASC' && isset( $arResult['order']['NAME'] ) )? 'DESC' : 'ASC' ?>">Имя пользователя
			<? if ( isset( $arResult['order']['NAME'] ) ) { ?>
			<span class="glyphicon glyphicon glyphicon-sort-by-alphabet<?=( $arResult['order']['NAME'] == 'DESC' )? '-alt' : ''?>" aria-hidden="true"></span>
			<? } ?>
			</a>
			</th>
		</thead>
		
		<tbody>
			
			<? foreach ( $arResult['users'] as $user ) { ?>
			<tr>
				<td><?=$user['ID']?></td>
				<td><?=$user['NAME']?></td>
				<td>
					<button type="button" class="deleteform btn btn-sm btn-danger" data-id="<?=$user['ID']?>">
						<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</td>
			</tr>
			<? } ?>
			
		</tbody>
		
	</table>
	<? } ?>
	
	<h3>Добавить пользователя</h3>
	
	<form class="form-inline" method="post">
	
		<input type="hidden" name="action" value="add">
	
		<div class="form-group">
			<input type="text" class="form-control" name="name" placeholder="имя пользователя">
		</div>
	
		<button type="submit" class="btn btn-success">Добавить</button>
	</form>
	
	
	<form id="delete_form" method="post">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="id" value="">
	</form>
</div>