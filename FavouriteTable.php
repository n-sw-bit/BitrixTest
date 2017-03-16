<?namespace Test\Entity;

use Bitrix\Main\Entity\IntegerField;

class FavouriteTable extends DataManager {
    public static function getTableName() {
        return 'test_user_list';
    }

    public static function getMap() {
        return [
            'ID' => new IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            'NAME' => new StringField('NAME', [
				'required' => true,
				'validation' => function() {
					return array(
						new Validator\RegExp('/[\d\w-_\sа-яА-ЯёЁ]{3,255}/'),
						new Validator\Unique()
					);
				}
			]) 
        ];
    }
}
