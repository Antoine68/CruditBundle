<?= "<?php" ?>
<?php if ($strictType): ?>


declare(strict_types=1);
<?php endif; ?>

namespace <?= $namespace; ?>;

<?php if($hasFilterset) { ?>use App\Crudit\Datasource\Filterset\<?= $entityClass ?>FilterSet;<?php echo "\n"; } ?>
use App\Entity\<?= $entityClass ?>;
use Lle\CruditBundle\Datasource\AbstractDoctrineDatasource;

class <?= $entityClass ?>Datasource extends AbstractDoctrineDatasource
{
    public function getClassName(): string
    {
        return <?= $entityClass ?>::class;
    }
<?php if($hasFilterset) { ?>

    /**
    * @required
    * @param <?= $entityClass ?>FilterSet $filterSet
    */
    public function setFilterset(<?= $entityClass ?>FilterSet $filterSet): void
    {
         $this->filterset = $filterSet;
    }
<?php } ?>
}
