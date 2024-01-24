<?php
namespace workanaSoftexpert\applications\services\productService;

use DateTime;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use workanaSoftexpert\core\dto\productCreateRequest\ProductCreateRequest;
use workanaSoftexpert\domain\entities\product\Product;
use workanaSoftexpert\domain\repositories\productRepository\ProductRepository;
use workanaSoftexpert\domain\repositories\productTypeRepository\ProductTypeRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;

class ProductService
{
    private $productRepository;
    private $productTypeRepository;
    private $userRepository;

    public function __construct(ProductRepository $productRepository, ProductTypeRepository $productTypeRepository, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->productTypeRepository = $productTypeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     * @throws \Exception
     */
    public function createProduct(ProductCreateRequest $request): Product
    {
        $productType = $this->productTypeRepository->find($request->productTypeId);
        if (!$productType) {
            throw new \RuntimeException("Product type not found.");
        }

        if ($productType->isExcluded()) {
            throw new \RuntimeException("Cannot create product with an excluded product type.");
        }

        $user = $this->userRepository->find($request->getCreatedByUserId());
        if (!$user) {
            throw new \RuntimeException("User not found."); // Ou trate o erro conforme necessário
        }

        $product = new Product();
        $product->setName($request->name);
        $product->setPrice($request->price);
        $product->setProductType($productType);
        $product->setCreatedByUser($user);

        $this->productRepository->save($product);

        return $product;
    }


    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws TransactionRequiredException
     */
    public function updateProduct($productId, ProductCreateRequest $request)
    {
        $product = $this->productRepository->find($productId);
        if (!$product) {
            throw new \RuntimeException("Product not found.");
        }

        $productType = $this->productTypeRepository->find($request->productTypeId);
        if (!$productType) {
            throw new \RuntimeException("Product type not found.");
        }

        if ($productType->isExcluded()) {
            throw new \RuntimeException("Cannot create product with an excluded product type.");
        }

        $product->setName($request->name);
        $product->setPrice($request->price);
        $product->setProductType($productType);
        $product->setUpdatedAt(new DateTime());

        $this->productRepository->save($product);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws TransactionRequiredException
     */
    public function deleteProduct($productId)
    {
        $product = $this->productRepository->find($productId);
        if (!$product) {
            throw new \RuntimeException("Product not found.");
        }

        $product->setExcluded(true);
        $this->productRepository->save($product);
    }

    public function getProductById($productId)
    {
        return $this->productRepository->find($productId);
    }

    public function getAllProducts() {
        return $this->productRepository->findAll();
    }
}
