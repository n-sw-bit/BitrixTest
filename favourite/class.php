<?

use Bitrix\Main\Loader;
use Test\FavouriteTable;

class UserList extends CBitrixComponent {
	
	// добавить пользователя и определить текст сообщения
    private function add_user( $name ) {
		
		$result = FavouriteTable::add( [ 'NAME' => $name ] );
		if ( $result->isSuccess() ) 
			return 'Пользователь успешно добавлен';
		else {
			$this->arResult['message_type'] = 'warning';
			return 'Имя пользователя может содержать только буквы, цифры, знак пробела, тире и нижние прочеркивание, от 3 до 250 символов. Либо пользователь уже есть в системе';
		}
		
    }
	
	// удалить пользователя и определить текст сообщения
    private function delete_user( $id ) {
		
		$result = FavouriteTable::delete( $id );
		if ( $result->isSuccess() ) 
			return 'Пользователь успешно удален';
		else {
			$this->arResult['message_type'] = 'warning';
			return 'Запись о пользователе не найдена, попробуйте снова';
		}
		
    }

    public function executeComponent() {
		
		$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest(); 

		// действия формы
		$this->arResult['message'] = false;
		$this->arResult['message_type'] = 'success';
		
		if ( !empty ( $request->getPost( 'action' ) ) ) {
			
			if ( $request->getPost( 'action' ) == 'add' ) 
				$this->arResult['message'] = $this->add_user( trim( $request->getPost( 'name' ) ) );
			
			elseif ( $request->getPost( 'action' ) == 'delete' ) 
				$this->arResult['message'] = $this->delete_user( (int) $request->getPost( 'id' ) );
			
			
		}
		
		// сортировка и поиск
		$order = ['ID' => 'ASC'];
		$search = [];
		
		if ( !empty ( $request->getQuery( 'sortby' ) ) ) {
			
			if ( $request->getQuery( 'sortby' ) == 'ID' )
				$order = ['ID' => (  $request->getQuery( 'sort' ) == 'DESC' )? 'DESC' : 'ASC' ];
			
			if ( $request->getQuery( 'sortby' ) == 'NAME' )
				$order = ['NAME' => (  $request->getQuery( 'sort' ) == 'DESC' )? 'DESC' : 'ASC' ];
				
		}
		$this->arResult['order'] = $order;
		
		
		if ( !empty ( $request->getQuery( 'search' ) ) ) {
			
			$search = ['%NAME' => $request->getQuery( 'search' )];
			$this->arResult['search_string'] = htmlspecialchars( $request->getQuery( 'search' ) );
			
		}
		
		// получаем таблицу значений
		$result = FavouriteTable::getList( [ 'order' => $order, 'select' => ['ID', 'NAME'], 'filter' => $search, 'limit' => 30 ] );
		$this->arResult['users'] = $result->fetchAll();
		
		$this->IncludeComponentTemplate();
		
    }
}