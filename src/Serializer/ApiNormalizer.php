<?php

namespace App\Serializer;

use App\Annotation\VichSerializableProperty;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;
use Vich\UploaderBundle\Storage\StorageInterface;

final class ApiNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    private $decorated;

    private $storage;

    private $annotationReader;

    private $requestContext;

    public function __construct(NormalizerInterface $decorated, StorageInterface $storage, Reader $annotationReader, RequestContext $requestContext)
    {
        if (!$decorated instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }

        $this->decorated = $decorated;
        $this->storage = $storage;
        $this->annotationReader = $annotationReader;
        $this->requestContext = $requestContext;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $this->prepareVichProperty($object);
        $data = $this->decorated->normalize($object, $format, $context);
        return $data;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->decorated->supportsDenormalization($data, $type, $format);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->decorated->denormalize($data, $class, $format, $context);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if ($this->decorated instanceof SerializerAwareInterface) {
            $this->decorated->setSerializer($serializer);
        }
    }

    /**
     * @param $object
     * @return mixed
     */
    private function prepareVichProperty($object)
    {
        $classAnnotation = $this->annotationReader->getClassAnnotation(
            ClassUtils::newReflectionClass(\get_class($object)),
            Uploadable::class
        );

        $uploadField = null;
        $reflectionClass = ClassUtils::newReflectionClass(\get_class($object));

        foreach ($reflectionClass->getProperties() as $property) {
            if ($this->annotationReader->getPropertyAnnotation($property, UploadableField::class)) {
                $uploadField = $property;
            }
        }

        if ($classAnnotation) {
            $reflectionClass = ClassUtils::newReflectionClass(\get_class($object));

            foreach ($reflectionClass->getProperties() as $property) {
                $propertyAnnotation = $this->annotationReader->getPropertyAnnotation($property, VichSerializableProperty::class);

                if ($propertyAnnotation && $uploadField) {
                    $property->setAccessible(true);
                    $uri = $this->storage->resolveUri($object, $uploadField->getName());
                    $property->setValue($object, $this->getHostUrl() . $uri);
                }
            }
        }

        return $object;
    }

    /**
     * Get host url (scheme://host:port).
     *
     * @return string
     */
    private function getHostUrl(): string
    {
        $scheme = $this->requestContext->getScheme();
        $url = $scheme . '://' . $this->requestContext->getHost();
        $httpPort = $this->requestContext->getHttpPort();
        $httpsPort = $this->requestContext->getHttpsPort();

        if ('http' === $scheme && $httpPort && 80 !== $httpPort) {
            return $url . ':' . $httpPort;
        }

        if ('https' === $scheme && $httpsPort && 443 !== $httpsPort) {
            return $url . ':' . $httpsPort;
        }

        return $url;
    }
}